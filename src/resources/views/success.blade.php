@extends('layouts.app')

@section('ttlbar')
    登録完了
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/success.css') }}">
@endsection

@section('ttl')
    本登録ありがとうございます
@endsection

@section('content')
        <div class="success">
            <div class="success__inner">ログインはこちら</div>
            <a class="success__inner" href="{{ route('login') }}">ログイン</a>
        </div>
@endsection
