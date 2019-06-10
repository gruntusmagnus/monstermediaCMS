<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Trigerma') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/perfect-scrollbar.js') }}" defer></script>
    <script src="{{ asset('js/public.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,400i,700&amp;subset=latin-ext" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="page">
        <header class="header">
            <div class="header__logo">
                <a href="/">
                    <img src="/img/logo.png" alt="Cyberbog">
                </a>
            </div>
            @include('extends.nav')
            <div class="header__alergen-link">
                <a href="/">{{ trans('navbar.listOfAlergens') }}</a>
            </div>
        </header>

        <main class="content">
            @yield('content')
        </main>

            @include('extends.footer')
    </div>
    @stack('javascript')
</body>
</html>
