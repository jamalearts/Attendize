<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicFormFieldValue extends Model
{
    protected $table = "dynamic_form_field_values";
    protected $fillable = [
        'registration_user_id',
        'dynamic_form_field_id',
        'value'
    ];

    /**
     * Get the registration user that owns the value.
     */
    public function registrationUser()
    {
        return $this->belongsTo(RegistrationUser::class);
    }

    /**
     * Get the field that owns the value.
     */
    public function field()
    {
        return $this->belongsTo(DynamicFormField::class, 'dynamic_form_field_id');
    }
}
