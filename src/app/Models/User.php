<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

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
        // デフォルトの確認メール無効化
    }
    public function sendPasswordResetNotification($token)
    {
        $url = URL::signedRoute('password.reset', ['token' => $token]);

        Mail::to($this->email)->send(new \App\Mail\SimpleResetPasswordMail($url));
    }

}
