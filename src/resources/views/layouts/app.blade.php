<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <!-- CSS読み込み -->
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('styles')
</head>

<body>
    @unless (View::hasSection('no_header'))
        <header class="header">
            <h1 class="logo">FashionablyLate</h1>
        </header>
    @endunless

    <main class="main">
        <h2 class="page-title">@yield('page_title')</h2>
        <div class="content">
            @yield('content')
        </div>
    </main>
</body>

</html>
