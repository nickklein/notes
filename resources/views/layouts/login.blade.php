<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="login-container">
            <nav>
                <div class="row">
                    <div id="logo">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'SecureNotes') }}
                        </a>
                    </div>

                    <ul id="navigation">
                        <li><a class="nav-link" href="{{ route('register') }}">{{ __('Create an account') }}</a></li>
                        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    </ul>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
