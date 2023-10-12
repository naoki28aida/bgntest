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

    <div class="act">
        <div class="act__have">ログインはこちら</div>
        <a class="act__have--in" href="{{ route('login') }}">ログイン</a>
    </div>
</div>
@endsection
