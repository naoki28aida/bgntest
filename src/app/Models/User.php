<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Notifications\VerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'id',
        'name',
        'email',
        'email_verified_at',
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
    ];

    public function days()
    {
        return $this->hasMany(Day::class);
    }

    public function workTimes()
    {
        return $this->hasMany(WorkTime::class);
    }
    public function sendEmailVerificationNotification()
    {
        // Do nothing, disable the default email verification notification.
    }
}
