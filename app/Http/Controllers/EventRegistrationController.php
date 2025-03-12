<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventRegistrationController extends Controller
{
    /**
     * @param Request $request
     * @param $event_id
     * @return mixed
     */
    public function showRegistration(Request $request, $event_id)
    {
        $allowed_sorts = ['name', 'status', 'start_date', 'end_date', 'approval_status'];

        $searchQuery = $request->get('q');
        $sort_order = $request->get('sort_order') == 'asc' ? 'asc' : 'desc';
        $sort_by = (in_array($request->get('sort_by'), $allowed_sorts) ? $request->get('sort_by') : 'created_at');

        // Get filter values
        $statusFilter = $request->get('status');
        $approvalStatusFilter = $request->get('approval_status');

        // Find event or return 404 error
        $event = Event::scope()->find($event_id);
        if ($event === null) {
            abort(404);
        }

        $registrationQuery = $event->registrations()
            ->withCount('users')  // Count related users
            ->with('categories'); // Eager load categories

        // Apply filters
        if ($statusFilter) {
            $registrationQuery->where('status', $statusFilter);
        }

        if ($approvalStatusFilter) {
            $registrationQuery->where('approval_status', $approvalStatusFilter);
        }

        // Apply search if provided
        if ($searchQuery) {
            $registrationQuery->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', "%{$searchQuery}%")
                    ->orWhere('approval_status', 'like', "%{$searchQuery}%")
                    ->orWhere('status', 'like', "%{$searchQuery}%")
                    ->orWhere('start_date', 'like', "%{$searchQuery}%")
                    ->orWhere('end_date', 'like', "%{$searchQuery}%");
            });
        }

        // Apply sorting
        $registration = $registrationQuery->orderBy($sort_by, $sort_order)->paginate(10);

        $data = [
            'registration' => $registration,
            'event' => $event,
            'sort_by' => $sort_by,
            'sort_order' => $sort_order,
            'q' => $searchQuery ?? '',
            'statusFilter' => $statusFilter,
            'approvalStatusFilter' => $approvalStatusFilter,
        ];

        return view('ManageEvent.Registration', $data);
    }


    public function showCreateRegistration(Request $request, $event_id)
    {
        $event = Event::scope()->find($event_id);
        if ($event === null) {
            abort(404);
        }

        $categories = $event->categories()->where('status', 'active')->pluck('name', 'id')->toArray();

        $data = [
            'event' => $event,
            'categories' => $categories
        ];

        return view('ManageEvent.Modals.CreateRegistration', $data);
    }

    /**
     * @param Request $request
     * @param $event_id
     * @return mixed
     */
    public function postCreateRegistration(Request $request, $event_id)
    {
        DB::beginTransaction();

        try {
            $registration = Registration::createNew();

            if (!$registration->validate($request->all())) {
                return response()->json([
                    'status' => 'error',
                    'messages' => $registration->errors(),
                ]);
            }

            $registration->event_id = $event_id;
            $registration->name = $request->get('name');
            $registration->status = $request->get('status');
            $registration->approval_status = $request->get('approval_status');
            $registration->start_date = $request->get('start_date');
            $registration->end_date = $request->get('end_date');

            // Handle image upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('registrations', 'public');
                $registration->image = $imagePath;
            }

            $registration->save();

            // Attach categories
            $registration->categories()->attach($request->get('categories'));

            DB::commit(); // Commit Transaction

            session()->flash('message', 'Successfully Created Registration');

            return response()->json([
                'status' => 'success',
                'id' => $registration->id,
                'message' => trans("Controllers.refreshing"),
                'redirectUrl' => route('showEventRegistration', ['event_id' => $event_id]),
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback Transaction on Error

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! Please try again.',
                'error' => $e->getMessage(),
            ]);
        }
    }

}
