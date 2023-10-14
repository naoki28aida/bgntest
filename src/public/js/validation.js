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
