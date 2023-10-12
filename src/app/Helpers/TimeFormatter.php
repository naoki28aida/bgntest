<?php

namespace App\Helpers;

class TimeFormatter
{
    public static function convertToHoursMins($minutes)
    {
        if ($minutes < 60) {
            return "{$minutes}分";
        } else {
            $hours = floor($minutes / 60);
            $remainingMinutes = $minutes % 60;
            return "{$hours}時間 {$remainingMinutes}分";
        }
    }
}
