@extends('layouts.app')

@section('ttlbar')
    勤怠管理システム
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('ttl')
    <div class="ttl">{{ Auth::user()->name }}さんお疲れ様です！</div>
@endsection

@section('content')
    <?php
    $latestBreak = $worktime ? $worktime->breakTimes()->latest('id')->first() : null;
    $onBreak = $latestBreak && !$latestBreak->end_time;
    ?>

    <div class="work">
        <!-- 出勤ボタン -->
        <form class="work__btn" action="{{ route('dashboard.workstart') }}" method="post">
            @csrf
            <input type="hidden" name="start_time" value="{{ time() }}">
            <input type="hidden" name="day" value="{{ now()->format('Y-m-d') }}">
            <button class="work__in {{ $day || ($worktime && ($worktime->work_end_time || !$worktime->work_start_time)) ? 'disabled' : '' }}" type="submit">出勤開始</button>
        </form>

        <!-- 出勤終了ボタン -->
        <form class="work__btn" action="{{ route('dashboard.workend') }}" method="post">
            @csrf
            <input type="hidden" name="end_time" value="{{ now()->format('Y-m-d') }}">
            <button class="work__in {{ !$worktime || !$worktime->work_start_time || $worktime->work_end_time || $onBreak ? 'disabled' : '' }}" type="submit">出勤終了</button>
        </form>

        <!-- 休憩開始ボタン -->
        <form class="work__btn" action="{{ route('dashboard.breakstart') }}" method="post">
            @csrf
            <button class="work__in {{ !$worktime || $worktime->work_end_time || $onBreak ? 'disabled' : '' }}" type="submit">休憩開始</button>
        </form>

        <!-- 休憩終了ボタン -->
        <form class="work__btn" action="{{ route('dashboard.breakend') }}" method="post">
            @csrf
            <button class="work__in {{ !$worktime || $worktime->work_end_time || !$onBreak ? 'disabled' : '' }}" type="submit">休憩終了</button>
        </form>
    </div>

@endsection
