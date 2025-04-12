<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DynamicFormField;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventRegistrationController extends Controller
{
    /**
     * @param Request $request
     * @param $event_id
     * @return mixed
     */
    public function showRegistration(Request $request, $event_id)
    {
        $allowed_sorts = ['name', 'status', 'start_date', 'end_date', 'approval_status', 'max_participants'];

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

        $registrationQuery = $event
            ->registrations()
            ->withCount('users')
            ->withCount([
                'users as new_users_count' => function ($query) {
                    $query->where('is_new', true);
                }
            ])
            ->with('category');

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
                $query
                    ->where('name', 'like', "%{$searchQuery}%")
                    ->orWhere('approval_status', 'like', "%{$searchQuery}%")
                    ->orWhere('status', 'like', "%{$searchQuery}%")
                    ->orWhere('start_date', 'like', "%{$searchQuery}%")
                    ->orWhere('end_date', 'like', "%{$searchQuery}%")
                    ->orWhere('max_participants', 'like', "%{$searchQuery}%");
            });
        }

        // Apply sorting
        $registration = $registrationQuery->orderBy($sort_by, $sort_order)->paginate(10);

        // Count total new registrations across all forms
        $newRegistrationsCount = $registration->sum('new_users_count');

        $data = [
            'registration' => $registration,
            'event' => $event,
            'sort_by' => $sort_by,
            'sort_order' => $sort_order,
            'q' => $searchQuery ?? '',
            'statusFilter' => $statusFilter,
            'approvalStatusFilter' => $approvalStatusFilter,
            'newRegistrationsCount' => $newRegistrationsCount,
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

    /**
     * Store a newly created registration in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $event_id
     * @return \Illuminate\Http\Response
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
            $registration->max_participants = $request->get('max_participants');
            $registration->category_id = $request->get('category_id');

            // Handle image upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('registrations', 'public');
                $registration->image = $imagePath;
            }

            $registration->save();

            // Create default form fields if no dynamic fields are provided
            if (!$request->has('dynamic_fields')) {
                // $this->createDefaultFormFields($registration);
            } else {
                // Then add custom dynamic fields
                $dynamicFields = $request->get('dynamic_fields');
                $sortOrder = 4;  // Start after default fields

                foreach ($dynamicFields as $field) {
                    if (empty($field['label'])) {
                        continue;
                    }

                    $formField = new DynamicFormField();
                    $formField->registration_id = $registration->id;
                    $formField->label = $field['label'];
                    $formField->name = Str::slug($field['label'], '_');
                    $formField->type = $field['type'];
                    $formField->is_required = isset($field['is_required']) ? true : false;
                    $formField->sort_order = $sortOrder++;

                    // Handle options for select, checkbox, radio
                    if (in_array($formField->type, ['select', 'checkbox', 'radio']) && !empty($field['options'])) {
                        $options = array_filter(explode("\n", $field['options']));
                        $formField->options = $options;
                    }

                    $formField->save();
                }
            }

            DB::commit();  // Commit Transaction

            session()->flash('message', 'Successfully Created Registration');

            return response()->json([
                'status' => 'success',
                'id' => $registration->id,
                'message' => trans('Controllers.refreshing'),
                'redirectUrl' => route('showEventRegistration', ['event_id' => $event_id]),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();  // Rollback Transaction on Error

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! Please try again.',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Create default form fields for a registration.
     *
     * @param \App\Models\Registration $registration
     * @return void
     */
    // protected function createDefaultFormFields(Registration $registration)
    // {
    //     // Create default form fields
    //     $defaultFields = [
    //         [
    //             'label' => 'First Name',
    //             'name' => 'first_name',
    //             'type' => 'text',
    //             'is_required' => true,
    //             'sort_order' => 0,
    //         ],
    //         [
    //             'label' => 'Last Name',
    //             'name' => 'last_name',
    //             'type' => 'text',
    //             'is_required' => true,
    //             'sort_order' => 1,
    //         ],
    //         [
    //             'label' => 'Email',
    //             'name' => 'email',
    //             'type' => 'email',
    //             'is_required' => true,
    //             'sort_order' => 2,
    //         ],
    //         [
    //             'label' => 'Phone',
    //             'name' => 'phone',
    //             'type' => 'tel',
    //             'is_required' => false,
    //             'sort_order' => 3,
    //         ],
    //     ];

    //     foreach ($defaultFields as $field) {
    //         DynamicFormField::create([
    //             'registration_id' => $registration->id,
    //             'label' => $field['label'],
    //             'name' => $field['name'],
    //             'type' => $field['type'],
    //             'is_required' => $field['is_required'],
    //             'sort_order' => $field['sort_order'],
    //         ]);
    //     }
    // }

    /**
     * Show the registration details modal.
     *
     * @param int $event_id
     * @param int $registration_id
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationDetails($event_id, $registration_id)
    {
        $event = Event::scope()->find($event_id);
        if ($event === null) {
            abort(404);
        }

        $registration = Registration::where('event_id', $event_id)
            ->where('id', $registration_id)
            ->with(['category', 'dynamicFormFields', 'registrationUsers'])
            ->firstOrFail();

        return view('ManageEvent.ViewRegistration', compact('registration', 'event'));
    }

    /**
     * Show the edit registration modal.
     *
     * @param int $event_id
     * @param int $registration_id
     * @return \Illuminate\Http\Response
     */
    public function showEditRegistration($event_id, $registration_id)
    {
        $registration = Registration::where('event_id', $event_id)
            ->where('id', $registration_id)
            ->firstOrFail();

        $categories = Category::where('event_id', $event_id)
            ->pluck('name', 'id')
            ->toArray();

        return view('ManageEvent.Modals.EditRegistration', compact('registration', 'categories', 'event_id'));
    }

    /**
     * Process the edit registration form submission.
     *
     * @param Request $request
     * @param int $event_id
     * @param int $registration_id
     * @return \Illuminate\Http\Response
     */
    public function postEditRegistration(Request $request, $event_id, $registration_id)
    {
        DB::beginTransaction();

        try {
            $registration = Registration::findOrFail($registration_id);

            // Validate the request
            $rules = [
                'name' => 'required|string|max:255',
                'max_participants' => 'nullable|integer|min:1',
                'category_id' => 'required|exists:categories,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'approval_status' => 'required|in:automatic,manual',
                'status' => 'required|in:active,inactive',
            ];

            $this->validate($request, $rules);

            // Update registration basic info
            $registration->name = $request->input('name');
            $registration->max_participants = $request->input('max_participants');
            $registration->category_id = $request->input('category_id');
            $registration->start_date = $request->input('start_date');
            $registration->end_date = $request->input('end_date');
            $registration->approval_status = $request->input('approval_status');
            $registration->status = $request->input('status');

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($registration->image) {
                    Storage::disk('public')->delete($registration->image);
                }

                $path = $request->file('image')->store('registrations', 'public');
                $registration->image = $path;
            }

            $registration->save();

            // Handle dynamic fields
            if ($request->has('dynamic_fields')) {
                foreach ($request->input('dynamic_fields') as $index => $fieldData) {
                    // If the field has an ID, it's an existing field to update
                    if (isset($fieldData['id'])) {
                        $field = DynamicFormField::find($fieldData['id']);
                        if ($field) {
                            $field->label = $fieldData['label'];
                            $field->name = Str::slug($fieldData['label'], '_');
                            $field->type = $fieldData['type'];
                            $field->options = isset($fieldData['options']) ? $fieldData['options'] : null;
                            $field->is_required = isset($fieldData['is_required']) ? true : false;
                            $field->sort_order = $index;
                            $field->save();
                        }
                    } else {
                        // Create a new field
                        DynamicFormField::create([
                            'registration_id' => $registration->id,
                            'label' => $fieldData['label'],
                            'name' => Str::slug($fieldData['label'], '_'),
                            'type' => $fieldData['type'],
                            'options' => isset($fieldData['options']) ? $fieldData['options'] : null,
                            'is_required' => isset($fieldData['is_required']) ? true : false,
                            'is_active' => true,
                            'sort_order' => $index,
                        ]);
                    }
                }
            }

            // Handle deleted fields
            if ($request->has('deleted_fields')) {
                DynamicFormField::whereIn('id', $request->input('deleted_fields'))->delete();
            }

            DB::commit();  // Commit Transaction

            session()->flash('message', 'Registration updated successfully');

            return response()->json([
                'status' => 'success',
                'message' => 'Registration updated successfully',
                'redirectUrl' => route('showEventRegistration', ['event_id' => $event_id]),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();  // Rollback Transaction on Error

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! Please try again.',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the delete registration modal.
     *
     * @param int $event_id
     * @param int $registration_id
     * @return \Illuminate\Http\Response
     */
    public function showDeleteRegistration($event_id, $registration_id)
    {
        $registration = Registration::where('event_id', $event_id)
            ->where('id', $registration_id)
            ->firstOrFail();

        return view('ManageEvent.Modals.DeleteRegistration', compact('registration', 'event_id'));
    }

    /**
     * Delete the registration.
     *
     * @param int $event_id
     * @param int $registration_id
     * @return \Illuminate\Http\Response
     */
    public function postDeleteRegistration($event_id, $registration_id)
    {
        $registration = Registration::where('event_id', $event_id)
            ->where('id', $registration_id)
            ->firstOrFail();

        DB::beginTransaction();

        try {
            // Delete related records
            $registration->dynamicFormFields()->delete();
            $registration->registrationUsers()->delete();
            $registration->delete();

            DB::commit();  // Commit Transaction

            session()->flash('message', 'Registration deleted successfully');

            return response()->json([
                'status' => 'success',
                'message' => 'Registration deleted successfully',
                'redirectUrl' => route('showEventRegistration', ['event_id' => $event_id]),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();  // Rollback Transaction on Error

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! Please try again.',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Bulk delete registrations.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $event_id
     * @return \Illuminate\Http\Response
     */
    public function postBulkDeleteRegistrations(Request $request, $event_id)
    {
        $registrationIds = $request->input('registration_ids', []);

        if (empty($registrationIds)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No registrations selected for deletion',
            ]);
        }

        DB::beginTransaction();

        try {
            $registrations = Registration::where('event_id', $event_id)
                ->whereIn('id', $registrationIds)
                ->get();

            foreach ($registrations as $registration) {
                // Delete related records
                $registration->dynamicFormFields()->delete();
                $registration->registrationUsers()->delete();
                $registration->delete();
            }

            DB::commit();  // Commit Transaction

            return response()->json([
                'status' => 'success',
                'message' => count($registrationIds) . ' registrations deleted successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();  // Rollback Transaction on Error

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! Please try again.',
                'error' => $e->getMessage(),
            ]);
        }
    }
}
