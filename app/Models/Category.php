<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class Category extends MyBaseModel
{

    protected $fillable = ['name', 'status', 'description', 'start_date', 'end_date'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];

    /**
     * The rules to validate the model.
     *
     * @return array $rules
     */
    public function rules()
    {
        $format = config('attendize.default_datetime_format');
        $event = Event::find(request()->route('event_id'));

        return [
            'name' => 'required',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable',
            'start_date' => [
                'required',
                "date_format:{$format}",
                function ($attribute, $value, $fail) use ($event) {
                    if ($event) {
                        $startDate = Carbon::createFromFormat('Y-m-d H:i', $value);
                        $eventStart = Carbon::parse($event->start_date);
                        $eventEnd = Carbon::parse($event->end_date);

                        if ($startDate->lt($eventStart)) {
                            $fail("The {$attribute} must be on or after the event start date ({$eventStart->format('Y-m-d H:i')}).");
                        }

                        if ($startDate->gt($eventEnd)) {
                            $fail("The {$attribute} must be on or before the event end date ({$eventEnd->format('Y-m-d H:i')}).");
                        }
                    }
                },
            ],
            'end_date' => [
                'required',
                "date_format:{$format}",
                'after:start_date',
                function ($attribute, $value, $fail) use ($event) {
                    if ($event && $value >= $event->end_date) {
                        $fail("The {$attribute} must be on or before the event end date ({$event->end_date}).");
                    }
                },
            ],
        ];
    }

    /**
     * The validation error messages.
     *
     * @var array $messages
     */
    public $messages = [
        'name.required' => 'You must at least give a name for your category. (e.g Early Registration)',
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

    /**
     * Parse start_date to a Carbon instance
     *
     * @param  string  $date  DateTime
     */
    public function setStartDateAttribute($date)
    {
        $format = config('attendize.default_datetime_format');

        if ($date instanceof Carbon) {
            $this->attributes['start_date'] = $date->format($format);
        } else {
            $this->attributes['start_date'] = Carbon::createFromFormat($format, $date);
        }
    }

    /**
     * Format start date from user preferences
     * @return String Formatted date
     */
    public function startDateFormatted()
    {
        return Carbon::parse($this->start_date)->format(config('attendize.default_datetime_format'));
    }

    /**
     * Parse end_date to a Carbon instance
     *
     * @param  string  $date  DateTime
     */
    public function setEndDateAttribute($date)
    {
        $format = config('attendize.default_datetime_format');

        if ($date instanceof Carbon) {
            $this->attributes['end_date'] = $date->format($format);
        } else {
            $this->attributes['end_date'] = Carbon::createFromFormat($format, $date);
        }
    }

    /**
     * Format end date from user preferences
     * @return String Formatted date
     */
    public function endDateFormatted()
    {
        return Carbon::parse($this->end_date)->format(config('attendize.default_datetime_format'));
    }

}
