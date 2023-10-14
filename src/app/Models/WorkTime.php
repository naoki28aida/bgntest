<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time',
        'break_time',
        'break_end_time',
        'user_id',
        'day_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function breakTimes()
    {
        return $this->hasMany(BreakTime::class, 'worktime_id', 'id');
    }

    public function break_times()
    {
        return $this->hasMany(BreakTime::class, 'worktime_id', 'id');
    }
}
