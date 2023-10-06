@extends('layouts.app')

@section('ttlbar')
    ログイン画面
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"/>
@endsection
@section('ttl')
    ログイン
@endsection
@section('content')
    <div class="form__content">
        <form class="form" action="/login" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}"/>
                        <div class="form__error"></div>
                    </div>
                </div>
            </div>


            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="password" name="password" placeholder="パスワード" value="{{ old('password') }}"/>
                        <div class="form__error"></div>
                    </div>
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">ログイン</button>
            </div>
        </form>

        <div class="act">
            <div class="act__have">アカウントをお持ちでない方はこちらから</div>
            <a class="act__have--in" href="/register">会員登録</a>
        </div>
    </div>
@endsection

@section('js')
@endsection
