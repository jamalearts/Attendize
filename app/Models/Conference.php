<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conference extends MyBaseModel
{
    protected $fillable = ['name', 'status', 'price', 'description', 'max_participants'];

    /**
     * The rules to validate the model.
     *
     * @return array $rules
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ];
    }

    /**
     * The validation error messages.
     *
     * @var array $messages
     */
    public $messages = [
        'name.required' => 'You must provide a name for your conference.',
        'name.string' => 'The name must be a valid string.',
        'name.max' => 'The name cannot exceed 255 characters.',
        'status.required' => 'Status is required.',
        'status.in' => 'Status must be either active or inactive.',
        'price.required' => 'Price is required.',
        'price.numeric' => 'Price must be a valid number.',
        'price.min' => 'Price must be at least 0.',
    ];
    protected $perPage = 10;

    /**
     * The event associated with the conference.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * The categories associated with the conference.
     *
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_conference');
    }

    /**
     * The professions associated with the conference.
     *
     * @return HasMany
     */
    public function professions()
    {
        return $this->hasMany(Profession::class);
    }
    
}
