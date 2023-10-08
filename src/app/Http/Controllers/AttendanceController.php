<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkTime;
use App\Models\BreakTime;
use App\Models\Day;
use App\Models\User;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        // 現在の日付を取得、もしリクエストパラメータに日付があればそれを使用
        $currentDate = $request->has('date') ? Carbon::parse($request->input('date')) : Carbon::now();

        // DBから指定された日の勤務データを取得
        $workTimes = WorkTime::with(['breakTimes', 'user'])
            ->whereHas('day', function ($query) use ($currentDate) {
                $query->whereDate('day', $currentDate);
            })
            ->paginate(5);

        return view('attendance', [
            'workTimes' => $workTimes,
            'currentDate' => $currentDate
        ]);
    }
}
