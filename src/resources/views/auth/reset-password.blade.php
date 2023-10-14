@extends('layouts.app')

@section('ttlbar')
    パスワード再設定
@endsection

@section('ttl')
    パスワード再設定
@endsection
@section('content')
    <div class="form__content">
        <form class="form" action="{{ route('password.update') }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="email" name="email" placeholder="メールアドレス" id="email" required>
                        <div class="form__error">@error('email'){{ $message }}@enderror</div>
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="password" name="password" placeholder="新しいパスワード" id="password" required>
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

            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="password" name="password_confirmation" placeholder="新しいパスワード（確認）" id="password_confirmation" required>
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
                <button class="form__button-submit" type="submit">パスワードを再設定する</button>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/validation.js') }}"></script>
@endsection
