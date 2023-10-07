<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakTime extends Model
{
    use HasFactory;

    protected $fillable = ['start_time', 'end_time', 'worktime_id'];

    public function worktime()
    {
        return $this->belongsTo(Worktime::class);
    }
}
