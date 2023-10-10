<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('ttlbar')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('css')
</head>
<header class="header">
    <div class="header__inner">
        <h2 class="header__logo">Atte</h2>
        @if(auth()->check())
            <div class="hamburger">
                <div class="hamburger__line"></div>
                <div class="hamburger__line"></div>
                <div class="hamburger__line"></div>
            </div>

            <nav class="hamburger__menu">
                <a class="header__menu" href="{{ route('home') }}">ホーム</a>
                <a class="header__menu" href="{{ route('attendance.index') }}">日付一覧</a>
                <a class="header__menu" href="{{ route('staff.user') }}">スタッフ一覧</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="header__menu" type="submit">ログアウト</button>
                </form>
                <button class="close-menu">閉じる</button>
            </nav>
        @endif


    </div>
</header>

<body>
<main class="main">
    <h2 class="main__ttl">@yield('ttl')</h2>
    @yield('content')


</main>
<footer class="footer__main">
    <small class="footer__logo">Atte, inc.</small>
</footer>
<script>
    $(document).ready(function () {
        $(".hamburger, .close-menu").on("click", function() {
            $(".hamburger__menu").toggleClass("active");
        });
    });
</script>
@yield('js')
</body>
</html>
