<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('ttlbar')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}"/>
    @yield('css')
</head>
<header class="header">
    <div class="header__inner">
        <h2 class="header__logo">Atte</h2>
        @if(auth()->check())
            <a class="header__menu" href="/">ホーム</a>
            <a class="header__menu" href="/">日付一覧</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="header__menu" type="submit">ログアウト</button>
            </form>
        @else

        @endif
    </div>
</header>

<body>
<main class="main">
    <h2 class="main__ttl">@yield('ttl')</h2>
    @yield('content')




</main>
<footer class="footer__main">
    <small class="footer__logo">Atte,inc.</small>
</footer>
@yield('js')
</body>
</html>
