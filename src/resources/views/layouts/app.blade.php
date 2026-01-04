<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Contact App')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- 共通CSS --}}
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">

    {{-- 画面別CSS --}}
    @yield('css')
</head>

<body class="@yield('body-class')">

    {{-- =====================
         ヘッダー
    ===================== --}}
    <header class="header">
        <div class="header__inner">

            {{-- ロゴ（常に中央） --}}
            <div class="header__logo">
                <a href="/">FashionablyLate</a>
            </div>

            {{-- 管理画面のみ表示（右端） --}}
            @if (trim($__env->yieldContent('body-class')) === 'admin')
                <div class="header__right">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                </div>
            @endif

        </div>
    </header>

    {{-- =====================
         メイン
    ===================== --}}
    <main class="main">
        @yield('content')
    </main>

</body>
</html>
