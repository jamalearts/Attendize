<?php

namespace App\Http\Controllers;

use App\Models\DynamicFormField;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DynamicFormFieldController extends Controller
{
    /**
     * Show the form for managing dynamic form fields.
     *
     * @param int $event_id
     * @param int $registration_id
     * @return \Illuminate\Http\Response
     */
    public function showManageFields($event_id, $registration_id)
    {
        $registration = Registration::where('event_id', $event_id)
            ->where('id', $registration_id)
            ->firstOrFail();

        $formFields = $registration->dynamicFormFields;
        $fieldTypes = DynamicFormField::getFieldTypes();

        return view('ManageEvent.Registrations.ManageFormFields', compact('registration', 'formFields', 'fieldTypes'));
    }

    /**
     * Store a newly created form field in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $event_id
     * @param int $registration_id
     * @return \Illuminate\Http\Response
     */
    public function storeField(Request $request, $event_id, $registration_id)
    {
        $registration = Registration::where('event_id', $event_id)
            ->where('id', $registration_id)
            ->firstOrFail();

        $request->validate([
            'label' => 'required|string|max:255',
            'type' => 'required|string|in:' . implode(',', array_keys(DynamicFormField::getFieldTypes())),
            'is_required' => 'boolean',
        ]);

        DB::beginTransaction();

        try {
            $formField = new DynamicFormField();
            $formField->registration_id = $registration->id;
            $formField->label = $request->input('label');
            $formField->name = str_slug($request->input('label'), '_');
            $formField->type = $request->input('type');
            $formField->is_required = $request->input('is_required', false);

            // Handle options for select, checkbox, radio
            if (in_array($formField->type, ['select', 'checkbox', 'radio']) && $request->has('options')) {
                $options = array_filter(explode("\n", $request->input('options')));
                $formField->options = $options;
            }

            // Set sort order to be the last
            $lastField = $registration->dynamicFormFields()->orderBy('sort_order', 'desc')->first();
            $formField->sort_order = $lastField ? $lastField->sort_order + 1 : 0;

            $formField->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Form field created successfully',
                'redirectUrl' => route('showManageFormFields', ['event_id' => $event_id, 'registration_id' => $registration_id]),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while creating the form field',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified form field in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $event_id
     * @param int $registration_id
     * @param int $field_id
     * @return \Illuminate\Http\Response
     */
    public function updateField(Request $request, $event_id, $registration_id, $field_id)
    {
        $formField = DynamicFormField::where('registration_id', $registration_id)
            ->where('id', $field_id)
            ->firstOrFail();

        $request->validate([
            'label' => 'required|string|max:255',
            'type' => 'required|string|in:' . implode(',', array_keys(DynamicFormField::getFieldTypes())),
            'is_required' => 'boolean',
            'is_active' => 'boolean',
        ]);

        DB::beginTransaction();

        try {
            $formField->label = $request->input('label');
            $formField->name = str_slug($request->input('label'), '_');
            $formField->type = $request->input('type');
            $formField->is_required = $request->input('is_required', false);
            $formField->is_active = $request->input('is_active', true);

            // Handle options for select, checkbox, radio
            if (in_array($formField->type, ['select', 'checkbox', 'radio']) && $request->has('options')) {
                $options = array_filter(explode("\n", $request->input('options')));
                $formField->options = $options;
            }

            $formField->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Form field updated successfully',
                'redirectUrl' => route('showManageFormFields', ['event_id' => $event_id, 'registration_id' => $registration_id]),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the form field',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified form field from storage.
     *
     * @param int $event_id
     * @param int $registration_id
     * @param int $field_id
     * @return \Illuminate\Http\Response
     */
    public function destroyField($event_id, $registration_id, $field_id)
    {
        $formField = DynamicFormField::where('registration_id', $registration_id)
            ->where('id', $field_id)
            ->firstOrFail();

        DB::beginTransaction();

        try {
            $formField->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Form field deleted successfully',
                'redirectUrl' => route('showManageFormFields', ['event_id' => $event_id, 'registration_id' => $registration_id]),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while deleting the form field',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the sort order of form fields.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $event_id
     * @param int $registration_id
     * @return \Illuminate\Http\Response
     */
    public function updateFieldOrder(Request $request, $event_id, $registration_id)
    {
        $request->validate([
            'field_ids' => 'required|array',
            'field_ids.*' => 'integer|exists:dynamic_form_fields,id',
        ]);

        DB::beginTransaction();

        try {
            $fieldIds = $request->input('field_ids');

            foreach ($fieldIds as $index => $fieldId) {
                DynamicFormField::where('id', $fieldId)
                    ->where('registration_id', $registration_id)
                    ->update(['sort_order' => $index]);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Field order updated successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating field order',
                'error' => $e->getMessage(),
            ]);
        }
    }
}