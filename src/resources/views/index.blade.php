@extends('layouts.app')

@section('ttlbar')
    勤怠管理システム
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('ttl')
    {{ Auth::user()->name }}さんお疲れ様です！
@endsection

@section('content')
    @if (session('message'))
        <div class="alert-message" id="alert-message">
            {{ session('message') }}
        </div>
    @endif
    <?php
    $latestBreak = $worktime ? $worktime->breakTimes()->latest('id')->first() : null;
    $onBreak = $latestBreak && !$latestBreak->end_time;
    ?>
    <div class="work__status">
    <div class="work__status--inner">
        @if($worktime && !$worktime->work_end_time)
            @if($onBreak)
                <p>休憩中</p>
            @else
                <p>出勤中</p>
            @endif
        @endif
    </div>
    </div>

    <div class="work">
        <!-- 出勤ボタン -->
        <form class="work__btn" id="work__btn--left" action="{{ route('dashboard.workstart') }}" method="post">
            @csrf
            <input type="hidden" name="start_time" value="{{ time() }}">
            <input type="hidden" name="day" value="{{ now()->format('Y-m-d') }}">
            <button class="work__in {{ $day || ($worktime && ($worktime->work_end_time || !$worktime->work_start_time)) ? 'disabled' : '' }}" type="submit">出勤開始</button>
        </form>

        <!-- 出勤終了ボタン -->
        <form class="work__btn" id="work__btn--right" action="{{ route('dashboard.workend') }}" method="post">
            @csrf
            <input type="hidden" name="end_time" value="{{ now()->format('Y-m-d') }}">
            <button class="work__in {{ !$worktime || !$worktime->work_start_time || $worktime->work_end_time || $onBreak ? 'disabled' : '' }}" type="submit">出勤終了</button>
        </form>

        <!-- 休憩開始ボタン -->
        <form class="work__btn" id="work__btn--left" action="{{ route('dashboard.breakstart') }}" method="post">
            @csrf
            <button class="work__in {{ !$worktime || $worktime->work_end_time || $onBreak ? 'disabled' : '' }}" type="submit">休憩開始</button>
        </form>

        <!-- 休憩終了ボタン -->
        <form class="work__btn" id="work__btn--right" action="{{ route('dashboard.breakend') }}" method="post">
            @csrf
            <button class="work__in {{ !$worktime || $worktime->work_end_time || !$onBreak ? 'disabled' : '' }}" type="submit">休憩終了</button>
        </form>
    </div>
@endsection
@section('js')
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            const alertMessage = document.getElementById('alert-message');
            if (alertMessage) {
                setTimeout(function() {
                    alertMessage.style.opacity = "0";
                    setTimeout(function() {
                        alertMessage.remove();
                    }, 1000);
                }, 4000); //
            }
        });
    </script>
@endsection
