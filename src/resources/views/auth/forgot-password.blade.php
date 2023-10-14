@extends('layouts.app')

@section('ttlbar')
    パスワード再設定画面
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/forgot-password.css') }}">
@endsection

@section('ttl')
    パスワードをお忘れのかた
@endsection

@section('content')
    <div class="forgot__password">
        <p class="forgot__password--inner">パスワード再設定用のメールをお送りします。</p>
        <p class="forgot__password--inner">記載されたURLをクリックしてパスワードの再設定をしてください。</p>
    </div>
    <div class="form">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form__input--text">
                <input class="form__button" type="email" id="email" placeholder="登録時のメールアドレス" name="email" required>
                <div class="form__error">@error('email'){{ $message }}@enderror</div>
                <button class="form__button-submit" id="button" type="submit">送信</button>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/validation_login.js') }}"></script>
@endsection
