<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Event;
use App\Models\Profession;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventRegistrationConferenceController extends Controller
{
    /**
     * @param Request $request
     * @param $event_id
     * @return mixed
     */
    public function showConferences(Request $request, $event_id)
    {

        $allowed_sorts = ['name', 'status', 'price'];

        // Getting get parameters.
        $searchQuery = $request->get('q');
        $sort_order = $request->get('sort_order') == 'asc' ? 'asc' : 'desc';
        $sort_by = (in_array($request->get('sort_by'), $allowed_sorts) ? $request->get('sort_by') : 'created_at');

        // Find event or return 404 error.
        $event = Event::scope()->find($event_id);
        if ($event === null) {
            abort(404);
        }

        // Get conferences for event.
        if ($searchQuery) {
            $conferences = $event->conferences()
                ->where(function ($query) use ($searchQuery) {
                    $query->where('name', 'like', $searchQuery . '%')
                        ->orWhere('max_participants', 'like', $searchQuery . '%')
                        ->orWhere('status', 'like', $searchQuery . '%')
                        ->orWhere('price', 'like', $searchQuery . '%');
                })
                ->paginate();
        } else {
            $conferences = $event->conferences()->orderBy($sort_by, $sort_order)->paginate();
        }


        $data = [
            'conferences' => $conferences,
            'event' => $event,
            'sort_by' => $sort_by,
            'sort_order' => $sort_order,
            'q' => $searchQuery ? $searchQuery : '',
        ];

        // Return view.
        return view('ManageEvent.RegistrationConferences', $data);
    }

    /**
     * Show the create Conference modal
     *
     * @param $event_id
     * @return \Illuminate\Contracts\View\View
     */
    public function showCreateConferences($event_id)
    {
        return view('ManageEvent.Modals.CreateConference', [
            'event' => Event::scope()->find($event_id),
        ]);
    }

    /**
     * Creates a conference
     *
     * @param $event_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateConference(Request $request, $event_id)
    {
        DB::beginTransaction(); // Start Transaction

        try {
            $conference = Conference::createNew();

            if (!$conference->validate($request->all())) {
                return response()->json([
                    'status' => 'error',
                    'messages' => $conference->errors(),
                ]);
            }

            $conference->event_id = $event_id;
            $conference->name = $request->get('name');
            $conference->status = $request->get('status');
            $conference->price = $request->get('price');
            $conference->description = prepare_markdown($request->get('description'));

            $conference->save();

            if ($request->get('professions')) {
                $professions = explode(',', $request->get('professions'));

                foreach ($professions as $professionName) {
                    $profession = new Profession();

                    if (!$profession->validate(["name" => $professionName, "conference_id" => $conference->id])) {
                        return response()->json([
                            'status' => 'error',
                            'messages' => $profession->errors(),
                        ]);
                    }

                    $profession->name = $professionName;
                    $profession->conference_id = $conference->id;

                    $profession->save();
                }

            }

            DB::commit(); // Commit Transaction

            session()->flash('message', 'Successfully Created Conference');

            return response()->json([
                'status' => 'success',
                'id' => $conference->id,
                'message' => trans("Controllers.refreshing"),
                'redirectUrl' => route('showEventRegistrationConferences', [
                    'event_id' => $event_id,
                ]),
            ]);

        } catch (Exception $e) {
            DB::rollBack(); // Rollback Transaction on Error

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! Please try again.',
                'error' => $e->getMessage(), // Optional: Show error details for debugging
            ]);
        }
    }

    /**
     * Show the 'Professions for Conference' modal
     *
     * @param Request $request
     * @param $event_id
     * @param $category_id
     * @return View
     */
    public function showProfessionsConference(Request $request, $event_id, $conference_id)
    {
        $conference = Conference::scope()->findOrFail($conference_id);

        $data = [
            'conference' => $conference,
        ];

        return view('ManageEvent.Modals.ProfessionsConference', $data);
    }

    /**
     * Show the 'Edit Conference' modal
     *
     * @param Request $request
     * @param $event_id
     * @param $category_id
     * @return View
     */
    public function showEditConference(Request $request, $event_id, $conference_id)
    {
        $conference = Conference::scope()->with('professions')->findOrFail($conference_id);

        $data = [
            'conference' => $conference,
            'event' => $conference->event,
        ];

        return view('ManageEvent.Modals.EditConference', $data);
    }

    /**
     * Updates an category
     *
     * @param Request $request
     * @param $event_id
     * @param $category_id
     * @return mixed
     */
    public function postEditConference(Request $request, $id)
    {
        try {

            // Validate the conference data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'status' => 'required|in:active,inactive',
                'price' => 'required|numeric|min:0',
                'description' => 'nullable|string',
                'professions' => 'nullable|string',
                'removed_professions' => 'nullable|string'
            ]);

            // Start a database transaction
            DB::beginTransaction();

            // Find the conference
            $conference = Conference::findOrFail($id);

            // Update the conference details
            $conference->update([
                'name' => $validatedData['name'],
                'status' => $validatedData['status'],
                'price' => $validatedData['price'],
                'description' => $validatedData['description'] ?? null
            ]);

            // Handle removed professions
            if ($request->has('removed_professions') && !empty($request->input('removed_professions'))) {
                $removedProfessions = explode(',', $request->input('removed_professions'));
                Profession::where('conference_id', $conference->id)
                    ->whereIn('name', $removedProfessions)
                    ->delete();
            }

            // Handle new or existing professions
            if ($request->has('professions') && !empty($request->input('professions'))) {
                $professionNames = explode(',', $request->input('professions'));

                // Add new professions or update existing
                foreach ($professionNames as $name) {
                    Profession::firstOrCreate([
                        'conference_id' => $conference->id,
                        'name' => trim($name)
                    ]);
                }
            }

            // Commit the transaction
            DB::commit();

            session()->flash('message', 'Successfully Created Conference');

            return response()->json([
                'status' => 'success',
                'id' => $conference->id,
                'message' => trans("Controllers.refreshing"),
                'redirectUrl' => route('showEventRegistrationConferences', [
                    'event_id' => $conference->event->id,
                ]),
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'messages' => $e->errors(),
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();

            // Return an error response
            return response()->json([
                'success' => false,
                'message' => 'Failed to update conference: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the 'Delete Conference' modal
     *
     * @param Request $request
     * @param $event_id
     * @param $conference_id
     * @return View
     */
    public function showDeleteConference($event_id, $conference_id)
    {
        $conference = Conference::scope()->findOrFail($conference_id);

        $data = [
            'conference' => $conference,
        ];

        return view('ManageEvent.Modals.DeleteConference', $data);
    }
    /**
     * Deleted a category
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postDeleteConference($event_id, $conference_id)
    {
        DB::beginTransaction(); // Start Transaction

        try {
            $conference = Conference::scope()->find($conference_id);

            /*
             * Don't allow deletion of conference which have been peaple register in this already.
             */
            // Logic is here


            // Check if the conference is linked to any category
            $isRelated = DB::table('category_conference')->where('conference_id', $conference_id)->exists();

            if ($isRelated) {
                DB::rollBack(); // Rollback Transaction

                session()->flash('message', 'This conference is related to a category and cannot be deleted.');

                return response()->json([
                    'status' => 'success',
                    'message' => 'This conference is related to a category and cannot be deleted.',
                    'id' => $conference->id,
                    'redirectUrl' => route('showEventRegistrationConferences', [
                        'event_id' => $event_id,
                    ]),
                ]);
            }

            // Delete the conference safely
            $conference->professions()->delete();
            $conference->delete();

            DB::commit(); // Commit Transaction

            session()->flash('message', trans("Successfully Deleted Conference"));

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Deleted Conference',
                'id' => $conference->id,
                'redirectUrl' => route('showEventRegistrationConferences', [
                    'event_id' => $event_id,
                ]),
            ]);
        } catch (Exception $e) {
            DB::rollBack(); // Rollback Transaction on Error

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! Please try again.',
                'error' => $e->getMessage(), // Optional: Show error details for debugging
            ]);
        }
    }

}
