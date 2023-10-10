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
}
