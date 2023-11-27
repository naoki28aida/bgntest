<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'user_id',
        'worktime_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function worktimes()
    {
        return $this->hasMany(Worktime::class);
    }

    public function work_times()
    {
        return $this->hasOne(WorkTime::class, 'day_id', 'id');
    }

}

