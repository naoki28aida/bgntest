@extends('layouts.app')

@section('ttlbar')
    月別勤務表
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/individual.css') }}">
@endsection

@section('ttl')
    <div class="title-container">
        <a href="{{ route('staff.individual', ['id' => $user->id, 'year' => $year, 'month' => $month-1]) }}">＜</a>
        {{ $user->name }}さん {{ $year }}年{{ $month }}月勤務表
        @php
            $currentYear = now()->year;
            $currentMonth = now()->month;
        @endphp
        @if ($year == $currentYear && $month >= $currentMonth)
            <span style="color: #aaa;">＞</span>
        @else
            <a href="{{ route('staff.individual', ['id' => $user->id, 'year' => $year, 'month' => $month+1]) }}">＞</a>
        @endif
    </div>
@endsection


@section('content')
    <div class="table-main">
        @php
            $currentMonth = now()->startOfMonth();
            $endOfMonth = now()->endOfMonth();
            $dates = [];
            $totalWorkTime = 0;
            $totalBreakTime = 0;

            while ($currentMonth->lte($endOfMonth)) {
                $dates[] = $currentMonth->copy();
                $currentMonth->addDay();
            }

            $recordedDays = collect($user->days)->keyBy(function($date) {
                return $date->day;
            });
        @endphp

        <table>
            <thead>
            <tr class="all__table">
                <th class="all__table--inner">日付</th>
                <th class="all__table--inner">出勤時間</th>
                <th class="all__table--inner">退勤時間</th>
                <th class="all__table--inner">休憩時間</th>
                <th class="all__table--inner">勤務時間</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dates as $date)
                @php
                    $day = $recordedDays->get($date->format('Y-m-d'));
                @endphp
                <tr class="all__table">
                    @php
                        $dateObj = \Carbon\Carbon::parse($date->format('Y-m-d'));
                        $weekday = $dateObj->isoFormat('ddd');
                        $color = "";

                        if($weekday == "土") {
                            $color = "blue";
                        } elseif($weekday == "日") {
                            $color = "red";
                        }

                    @endphp

                    <td class="all__table--day" style="color: {{ $color }};">
                        {{ $date->format('Y-m-d') }}（ {{ $weekday }} ）
                    </td>

                    @if($day)
                        @php
                            $breakTimeTotal = 0;
                        @endphp
                        @if(isset($day->work_times->break_times) && is_iterable($day->work_times->break_times))
                            @foreach($day->work_times->break_times as $break_time)
                                @php
                                    $breakTimeTotal += \Carbon\Carbon::parse($break_time->start_time)->diffInSeconds(\Carbon\Carbon::parse($break_time->end_time));
                                @endphp
                            @endforeach
                        @endif
                        @php
                            $startTimeInSeconds = $day->work_times ? \Carbon\Carbon::parse($day->work_times->work_start_time)->diffInSeconds(today()->startOfDay()) : 0;
                            $endTimeInSeconds = $day->work_times ? \Carbon\Carbon::parse($day->work_times->work_end_time)->diffInSeconds(today()->startOfDay()) : 0;
                            $workTimeTotal = floor((($endTimeInSeconds - $startTimeInSeconds) - $breakTimeTotal) / 60);
                            $totalWorkTime += $workTimeTotal;
                            $totalBreakTime += floor($breakTimeTotal / 60);
                        @endphp

                        <td class="all__table--day">{{ optional($day->work_times)->work_start_time }}</td>
                        <td class="all__table--day">{{ optional($day->work_times)->work_end_time }}</td>
                        <td class="all__table--day">@convertToHoursMins(floor($breakTimeTotal / 60))</td>
                        <td class="all__table--day">@convertToHoursMins($workTimeTotal)</td>
                    @else
                        <td class="all__table--day">---</td>
                        <td class="all__table--day">---</td>
                        <td class="all__table--day">---</td>
                        <td class="all__table--day">---</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>

    <div class="total">
        <p class="total__inner">総出勤日数: {{ count($user->days) }}日</p>
        <p class="total__inner">総出勤時間: @convertToHoursMins($totalWorkTime)</p>
        <p class="total__inner">総休憩時間: @convertToHoursMins($totalBreakTime)</p>
    </div>
    </div>
@endsection

@section('js')
@endsection
