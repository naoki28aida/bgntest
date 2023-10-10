@extends('layouts.app')

@section('ttlbar')
    新規登録画面
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
                        <input type="text" name="name" placeholder="名前" value="{{ old('name') }}" maxlength="191"/>
                        <div class="form__error">@error('name'){{ $message }}
                            @enderror</div>
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" maxlength="191"/>
                        <div class="form__error">@error('email'){{ $message }}
                            @enderror</div>
                    </div>
                </div>
            </div>


            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="password" name="password" placeholder="パスワード" value="{{ old('password') }}" maxlength="191"/>
                        <div class="form__error">@error('password'){{ $message }}
                            @enderror</div>
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="password" name="password_confirmation" placeholder="確認用パスワード"
                               value="{{ old('password_confirmation') }}" maxlength="191"/>
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
    <script>
        $(document).ready(function () {
            function validateInput(inputElement) {
                let inputName = inputElement.attr('name');
                let inputValue = inputElement.val().trim();
                let errorMessage = '';

                switch(inputName) {
                    case 'name':
                        if (inputValue === "") errorMessage = '名前は必須項目です。';
                        else if (typeof inputValue !== 'string') errorMessage = '名前は文字列でなければなりません。';
                        else if (inputValue.length > 191) errorMessage = '名前は191文字以下で入力してください。';
                        break;

                    case 'email':
                        if (inputValue === "") errorMessage = 'メールアドレスは必須項目です。';
                        else if (typeof inputValue !== 'string') errorMessage = 'メールアドレスは文字列でなければなりません。';
                        else if (!/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/.test(inputValue)) errorMessage = '有効なメールアドレスを入力してください。';
                        else if (inputValue.length > 191) errorMessage = 'メールアドレスは191文字以下で入力してください。';
                        break;

                    case 'password':
                        if (inputValue === "") errorMessage = 'パスワードは必須項目です。';
                        else if (typeof inputValue !== 'string') errorMessage = 'パスワードは文字列でなければなりません。';
                        else if (inputValue.length < 8) errorMessage = 'パスワードは8文字以上で入力してください。';
                        else if (inputValue.length > 191) errorMessage = 'パスワードは191文字以下で入力してください。';
                        break;

                    case 'password_confirmation':
                        if (inputValue !== $('input[name="password"]').val()) errorMessage = '確認用のパスワードと一致しません。';
                        break;
                }

                inputElement.siblings('.form__error').text(errorMessage);
            }


            $('input').on('blur', function () {
                validateInput($(this));
            });


            $('input').on('input', function () {
                validateInput($(this));
            });
        });
    </script>

@endsection
