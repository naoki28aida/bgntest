@extends('layouts.app')

@section('ttlbar')
    勤怠情報
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('ttl')
        <a class="day__btn" href="{{ route('attendance.index', ['date' => $currentDate->copy()->subDay()->format('Y-m-d')]) }}">&lt;</a>
        {{ $currentDate->format('Y-m-d') }}
        <a class="day__btn" href="{{ route('attendance.index', ['date' => $currentDate->copy()->addDay()->format('Y-m-d')]) }}">&gt;</a>
@endsection

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="rlt">
        <table class="rlt__table__inner">
            <tr class="sys_menu">
                <th class="rlt_ttl">名前</th>
                <th class="rlt_ttl">勤務開始</th>
                <th class="rlt_ttl">勤務終了</th>
                <th class="rlt_ttl">休憩時間</th>
                <th class="rlt_ttl">勤務時間</th>
            </tr>

            @foreach ($workTimes as $workTime)
                @php
                    // 休憩時間を秒単位で計算
                    $breakDurationSeconds = $workTime->breakTimes->sum(function($break) {
                        $start = Carbon::parse($break->start_time);
                        $end = Carbon::parse($break->end_time);
                        return $end->diffInSeconds($start);
                    });
                    $hours = floor($breakDurationSeconds / 3600);
                    $minutes = floor(($breakDurationSeconds % 3600) / 60);
                    $seconds = $breakDurationSeconds % 60;
                    $breakDuration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

                    // 勤務時間を秒単位で計算
                    $workStart = Carbon::parse($workTime->work_start_time);
                    $workEnd = Carbon::parse($workTime->work_end_time);
                    $workDurationSeconds = $workEnd->diffInSeconds($workStart) - $breakDurationSeconds;
                    $hours = floor($workDurationSeconds / 3600);
                    $minutes = floor(($workDurationSeconds % 3600) / 60);
                    $seconds = $workDurationSeconds % 60;
                    $workDuration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                @endphp
                <tr class="sys_menu">
                    <td class="rlt_ttl">{{ $workTime->user->name }}</td>
                    <td class="rlt_ttl">{{ $workTime->work_start_time }}</td>
                    <td class="rlt_ttl">{{ $workTime->work_end_time }}</td>
                    <td class="rlt_ttl">{{ $breakDuration }}</td>
                    <td class="rlt_ttl">{{ $workDuration }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="pagination-wrapper">
        {{ $workTimes->appends(['date' => $currentDate->format('Y-m-d')])->links('pagination::bootstrap-4') }}
    </div>
@endsection
