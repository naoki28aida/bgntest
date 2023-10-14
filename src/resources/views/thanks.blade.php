@extends('layouts.app')

@section('ttlbar')
    登録申請ありがとうございます！
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('ttl')
    仮登録ありがとうございます！
@endsection

@section('content')
<div class="thanks">
    <p class="thanks__message">ご登録いただいたメールに本登録用のURLが届いております。</p>
    <p class="thanks__message">URLをクリックして本登録の方を完了してください。</p>
    @if (session('status'))
        <div id="re__message">
            {{ session('status') }}
        </div>
    @endif
        <div class="re__message--form"><form class="form" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit">確認メールを再送</button>
        </form></div>
    </div>
<script src="{{ asset('js/thanks.js') }}"></script>
@endsection
