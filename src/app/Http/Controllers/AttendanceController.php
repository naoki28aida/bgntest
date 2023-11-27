<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkTime;
use App\Models\User;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $currentDate = $request->has('date') ? Carbon::parse($request->input('date')) : Carbon::now();

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
    public function user(Request $request)
    {
        $users = User::paginate(5);

        return view('staff', [
            'users' => $users
        ]);
    }
    public function showIndividual($id, Request $request)
    {
        $user = User::with(['days', 'days.work_times', 'days.work_times.break_times'])->find($id);

        if (!$user) {
            return redirect('/attendance/user')->with('error', 'スタッフ情報が見つかりませんでした。');
        }

        $year = $request->input('year', now()->year);
        $month = $request->input('month', now()->month);

        $startOfMonth = Carbon::create($year, $month, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        $user->days = $user->days->filter(function ($day) use ($startOfMonth, $endOfMonth) {
            $dayDate = Carbon::parse($day->day);
            return $dayDate->gte($startOfMonth) && $dayDate->lte($endOfMonth);
        });

        return view('staff.individual', compact('user', 'year', 'month'));
    }

}
