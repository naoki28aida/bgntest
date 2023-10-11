@extends('layouts.app')

@section('ttlbar')
    スタッフ一覧
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/staff.css') }}">
@endsection

@section('ttl')
スタッフ一覧
@endsection

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="rlt">
        <table class="rlt__table__inner">
            <tr class="sys_menu">
                <th class="rlt_ttl">スタッフ名</th>
                <th class="rlt_ttl">登録日</th>
                <th class="rlt_ttl">最終出勤日</th>
            </tr>

            @foreach($users as $user)
                <tr class="sys_menu">
                    <td class="rlt_ttl">
                        <a href="{{ route('staff.individual', ['id' => $user->id]) }}">{{ $user->name }}</a>
                    </td>
                    <td class="rlt_ttl">{{ \Carbon\Carbon::parse($user->created_at)->format('Y年m月d日') }}</td>
                    <td class="rlt_ttl">
                        @php
                            $latestWorkTime = $user->workTimes()->latest('day_id')->first();
                            $latestDay = $latestWorkTime ? $latestWorkTime->day->day : null;
                        @endphp
                        {{ $latestDay ? Carbon::parse($latestDay)->format('Y年m月d日') : '---' }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="pagination__main">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
@endsection
