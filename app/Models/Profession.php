<?php


namespace App\Models;

class Profession extends MyBaseModel
{
    protected $fillable = ['name', 'conference_id'];

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'conference_id' => 'required|exists:conferences,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The conference name is required.',
            'name.string' => 'The conference name must be a valid string.',
            'name.max' => 'The conference name may not be greater than 255 characters.',
            'conference_id.required' => 'The conference selection is required.',
            'conference_id.exists' => 'The selected conference is invalid.',
        ];
    }

    /**
     * The Conference associated with the Profession.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }
}
