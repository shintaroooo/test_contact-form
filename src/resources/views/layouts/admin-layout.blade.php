<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>FashionablyLate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @yield('styles')
</head>

<body class="admin-body">
    <header class="auth-header auth-header__admin">
        <h1 class="logo">FashionablyLate</h1>

        <div class="auth-action">
            {{-- ログインしている場合 --}}
            @auth
                <form method="POST" action="{{ route('logout.view') }}">
                    @csrf
                    <button type="submit" class="auth-btn">logout</button>
                </form>
            @endauth
            {{-- ログインしていない場合 --}}
            @guest
                @if (request()->routeIs('login'))
                    <a href="{{ route('register') }}" class="auth-btn">register</a>
                @else
                    <a href="{{ route('login') }}" class="auth-btn">login</a>
                @endif
            @endguest
        </div>
    </header>

    <main class="admin-main">
        <h2 class="page-title">@yield('page_title')</h2>
        @yield('content')
    </main>

    @yield('scripts')
</body>

</html>
