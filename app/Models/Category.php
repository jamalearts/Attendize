<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends MyBaseModel
{

    protected $fillable = ['name', 'max_participants', 'status', 'description', 'start_date', 'end_date'];

    /**
     * The rules to validate the model.
     *
     * @return array $rules
     */
    public function rules()
    {
        $format = config('attendize.default_datetime_format');
        return [
            'name' => 'required',
            'conferences' => 'required|array',
            'conferences.*' => 'exists:conferences,id',
            'status' => 'required|in:active,inactive',
            'max_participants' => 'nullable|integer',
            'description' => 'nullable',
            'start_date' => 'nullable|date_format:"' . $format . '"',
            'end_date' => 'nullable|date_format:"' . $format . '"|after:start_date',
        ];
    }

    /**
     * The validation error messages.
     *
     * @var array $messages
     */
    public $messages = [
        'name.required' => 'You must at least give a name for your category. (e.g Early Registration)',
        'max_participants.integer' => 'Please ensure the max participants available is a number.',
    ];
    protected $perPage = 10;

    /**
     * The conferences associated with the category.
     *
     * @return BelongsToMany
     */
    public function conferences()
    {
        return $this->belongsToMany(Conference::class, 'category_conference', 'category_id', 'conference_id');
    }

    /**
     * The event associated with the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
