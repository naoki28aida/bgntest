<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Day;
use App\Models\WorkTime;
use App\Models\BreakTime;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = now()->format('Y-m-d');
        $day = Day::where('user_id', $user->id)->where('day', $today)->first();
        $worktime = WorkTime::where('user_id', $user->id)->where('day_id', $day->id ?? null)->latest('id')->first();

        return view('index', compact('day', 'worktime'));
    }
    public function startAttendance(Request $request)
    {
        $user = Auth::user();

        // Dayのレコードを作成
        $day = new Day;
        $day->day = $request->day;
        $day->user_id = $user->id;
        $day->save();

        // Timestampのレコードを作成
        $worktime = new Worktime;
        $worktime->work_start_time = now()->format('H:i');
        $worktime->user_id = $user->id;
        $worktime->day_id = $day->id;
        $worktime->save();

        return back()->with('message', '出勤を開始しました！');
    }


    public function endAttendance(Request $request)
    {
        $user = Auth::user();

        $worktime = Worktime::where('user_id', $user->id)->latest('id')->first();

        if ($worktime) {
            $worktime->work_end_time = now()->format('H:i');
            $worktime->save();
        }

        return back()->with('message', '退勤しました！');
    }

    public function startBreak(Request $request)
    {
        $user = Auth::user();
        $worktime = WorkTime::where('user_id', $user->id)->latest('id')->first();

        if ($worktime && !$worktime->work_end_time) {
            $break = new BreakTime;
            $break->start_time = now()->format('H:i');
            $break->worktime_id = $worktime->id;
            $break->save();


            return back()->with('message', '休憩に入ります');
        }

        return back()->with('error', 'エラーが発生しました');
    }
    public function endBreak(Request $request)
    {
        $user = Auth::user();
        $worktime = WorkTime::where('user_id', $user->id)->latest('id')->first();

        if ($worktime) {
            $lastBreak = $worktime->breakTimes()->latest('id')->first();

            if ($lastBreak && !$lastBreak->end_time) {
                $lastBreak->end_time = now()->format('H:i');
                $lastBreak->save();

                return back()->with('message', '休憩終了');
            }
        }

        return back()->with('error', 'エラーが発生しました');
    }

}

