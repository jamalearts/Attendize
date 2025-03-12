<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RegistrationUser extends Pivot
{

    protected $table = 'registration_users';

    protected $fillable = [
        'registration_id',
        'category_id',
        'profession_id',
        'conference_id',
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'status'
        // 'state_id',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function state()
    // {
    //     return $this->belongsTo(State::class);
    // }
}
