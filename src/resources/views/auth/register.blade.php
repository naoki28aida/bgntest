@extends('layouts.app')

@section('ttlbar')
    新規登録画面
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}"/>
@endsection
@section('ttl')
    会員登録
@endsection
@section('content')
    <div class="form__content">
        <form class="form" action="/register" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="name" placeholder="名前" value="{{ old('name') }}"/>
                        <div class="form__error">@error('name'){{ $message }}
                            @enderror</div>
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}"/>
                        <div class="form__error">@error('email'){{ $message }}
                            @enderror</div>
                    </div>
                </div>
            </div>


            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="password" name="password" placeholder="パスワード" value="{{ old('password') }}"/>
                        <div class="form__error">@error('password'){{ $message }}
                            @enderror</div>
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="password" name="password_confirmation" placeholder="確認用パスワード"
                               value="{{ old('password_confirmation') }}"/>
                        <div class="form__error">@error('password_confirmation'){{ $message }}
                            @enderror</div>
                    </div>
                </div>
            </div>

            <div class="form__button">
                <button class="form__button-submit" type="submit">会員登録</button>
            </div>
        </form>

        <div class="act">
            <div class="act__have">アカウントをお持ちの方はこちら</div>
            <a class="act__have--in" href="{{ route('login') }}">ログイン</a>

        </div>
    </div>
@endsection

@section('js')
@endsection
