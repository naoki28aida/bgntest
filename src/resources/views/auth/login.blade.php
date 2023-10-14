@extends('layouts.app')

@section('ttlbar')
    ログイン画面
@endsection

@section('ttl')
    ログイン
@endsection
@section('content')

    <div id="popupMessage" data-message="{{ Session::get('success', '') }}" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: red; padding: 20px; z-index: 1000; color: white; border-radius: 12px;">
        <p id="popupText"></p>
    </div>
    <div class="form__content">
        <form class="form" action="/login" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" maxlength="191"/>
                        <div class="form__error">@error('email'){{ $message }}@enderror</div>
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="password" name="password" placeholder="パスワード" value="{{ old('password') }}" maxlength="191"/>
                        <div class="form__error">@error('password'){{ $message }}@enderror
                            @if ($errors->has('login'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('login') }}
                                </div>
                            @endif
                        </div>
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
        <div class="act">
            <div class="act__have">パスワードをお忘れの方はこちらから</div>
            <a class="act__have--in" href="/forgot-password">パスワード再設定</a>
        </div>
    </div>
    <script src="{{ asset('js/validation_login.js') }}"></script>
    <script src="{{ asset('js/mail_popup.js') }}"></script>
@endsection
