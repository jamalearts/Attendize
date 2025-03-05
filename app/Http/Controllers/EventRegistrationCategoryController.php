<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Conference;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class EventRegistrationCategoryController extends MyBaseController
{
    /**
     * @param Request $request
     * @param $event_id
     * @return mixed
     */
    public function showCategories(Request $request, $event_id)
    {

        $allowed_sorts = ['name', 'max_participants', 'status', 'start_date', 'end_date'];

        // Getting get parameters.
        $searchQuery = $request->get('q');
        $sort_order = $request->get('sort_order') == 'asc' ? 'asc' : 'desc';
        $sort_by = (in_array($request->get('sort_by'), $allowed_sorts) ? $request->get('sort_by') : 'created_at');

        // Find event or return 404 error.
        $event = Event::scope()->find($event_id);
        if ($event === null) {
            abort(404);
        }

        // Get categories for event.
        if ($searchQuery) {
            $categories = $event->categories()
                ->where(function ($query) use ($searchQuery) {
                    $query->where('name', 'like', $searchQuery . '%')
                        ->orWhere('max_participants', 'like', $searchQuery . '%')
                        ->orWhere('status', 'like', $searchQuery . '%')
                        ->orWhere('start_date', 'like', $searchQuery . '%')
                        ->orWhere('end_date', 'like', $searchQuery . '%');
                })
                ->paginate();
        } else{
            $categories = $event->categories()->orderBy($sort_by, $sort_order)->paginate();
        }


        $data = [
            'categories'  => $categories,
            'event'      => $event,
            'sort_by'    => $sort_by,
            'sort_order' => $sort_order,
            'q'          => $searchQuery ? $searchQuery : '',
        ];

        // Return view.
        return view('ManageEvent.RegistrationCategories', $data);
    }

    /**
     * Show the create category modal
     *
     * @param $event_id
     * @return \Illuminate\Contracts\View\View
     */
    public function showCreateCategory($event_id)
    {
        // Get all conference for event
        $conferences = Conference::where('event_id', $event_id)->pluck('name', 'id')->toArray();

        return view('ManageEvent.Modals.CreateCategory', [
            'event' => Event::scope()->find($event_id),
            'conferences' => $conferences
        ]);
    }

    /**
     * Creates a category
     *
     * @param $event_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateCategory(Request $request, $event_id)
    {
        DB::beginTransaction(); // Start Transaction

        try {
            $category = Category::createNew();

            if (!$category->validate($request->all())) {
                return response()->json([
                    'status' => 'error',
                    'messages' => $category->errors(),
                ]);
            }

            $category->event_id = $event_id;
            $category->name = $request->get('name');
            $category->max_participants = $request->get('max_participants') ?: null;
            $category->status = $request->get('status');
            $category->start_date = $request->get('start_date');
            $category->end_date = $request->get('end_date');
            $category->description = prepare_markdown($request->get('description'));

            $category->save();

            if ($request->get('conferences')) {
                $category->conferences()->attach($request->get('conferences'));
            }

            DB::commit(); // Commit Transaction

            session()->flash('message', 'Successfully Created Category');

            return response()->json([
                'status' => 'success',
                'id' => $category->id,
                'message' => trans("Controllers.refreshing"),
                'redirectUrl' => route('showEventRegistrationCategories', [
                    'event_id' => $event_id,
                ]),
            ]);

        } catch (Exception $e) {
            DB::rollBack(); // Rollback Transaction on Error

            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong! Please try again.',
                'error'   => $e->getMessage(), // Optional: Show error details for debugging
            ]);
        }
    }

    /**
     * Show the 'Edit Category' modal
     *
     * @param Request $request
     * @param $event_id
     * @param $category_id
     * @return View
     */
    public function showEditCategory(Request $request, $event_id, $category_id)
    {
        $category = Category::scope()->findOrFail($category_id);
        $conferences = Conference::where('event_id', $event_id)->pluck('name', 'id')->toArray();

        $data = [
            'category'     => $category,
            'event'        => $category->event,
            'conferences'  => $conferences,
        ];

        return view('ManageEvent.Modals.EditCategory', $data);
    }

    /**
     * Updates an category
     *
     * @param Request $request
     * @param $event_id
     * @param $category_id
     * @return mixed
     */
    public function postEditCategory(Request $request, $event_id, $category_id)
    {
        DB::beginTransaction(); // Start Transaction

        try{
            $category = Category::scope()->findOrFail($category_id);

            if (!$category->validate($request->all())) {
                return response()->json([
                    'status' => 'error',
                    'messages' => $category->errors(),
                ]);
            }

            $category->update($request->all());

            if ($request->has('conferences')) {
                $category->conferences()->sync($request->get('conferences'));
            }

            DB::commit(); // Commit Transaction

            session()->flash('message',trans("Successfully Updated Category"));

            return response()->json([
                'status'       => 'success',
                'id'           => $category->id,
                'message'      => trans("Controllers.refreshing"),
                'redirectUrl'  => route('showEventRegistrationCategories', [
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
     * Show the 'Conferences Category' modal
     *
     * @param Request $request
     * @param $event_id
     * @param $category_id
     * @return View
     */
    public function showConferencesCategory(Request $request, $event_id ,$category_id)
    {
        $category = Category::scope()->findOrFail($category_id);

        $data = [
            'category' => $category,
        ];

        return view('ManageEvent.Modals.ConferencesCategory', $data);
    }

    /**
     * Show the 'Delete Category' modal
     *
     * @param Request $request
     * @param $event_id
     * @param $category_id
     * @return View
     */
    public function showDeleteCategory(Request $request, $event_id ,$category_id)
    {
        $category = Category::scope()->findOrFail($category_id);

        $data = [
            'category' => $category,
        ];

        return view('ManageEvent.Modals.DeleteCategory', $data);
    }
    /**
     * Deleted a category
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postDeleteCategory(Request $request, $event_id, $category_id)
    {
        DB::beginTransaction(); // Start Transaction

        try{
            $category = Category::scope()->find($category_id);

            /*
            * Don't allow deletion of category which have been peaple register in this already.
            */
            // if ($category) {
            //     return response()->json([
            //         'status'  => 'error',
            //         'message' => trans("Controllers.cant_delete_category_when_registered"),
            //         'id'      => $category->id,
            //     ]);
            // }

            // Delete the category safely
            $category->conferences()->detach();
            $category->delete();


            DB::commit(); // Commit Transaction

            session()->flash('message',trans("Successfully Deleted Category"));

            return response()->json([
                'status'       => 'success',
                'message'      => 'Successfully Deleted Category',
                'id'           => $category->id,
                'redirectUrl'  => route('showEventRegistrationCategories', [
                    'event_id' => $event_id,
                ]),
            ]);
        } catch (Exception $e) {
            DB::rollBack(); // Rollback Transaction on Error

            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong! Please try again.',
                'error'   => $e->getMessage(), // Optional: Show error details for debugging
            ]);
        }
    }
}
