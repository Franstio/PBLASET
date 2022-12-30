<!DOCTYPE html>
<html class="h-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Argon Dashboard') }}</title>
        <!-- Favicon -->
        <link href="{{ asset('argon') }}/img/brand/favicon.ico" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Extra details for Live View on GitHub Pages -->


        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.13.1/css/dataTables.jqueryui.min.css" rel="stylesheet">
        @vite(['resources/css/app.css','resources/js/app.js'])
        <style>
            .v-application--wrap {
              min-height: 0vh !important;
              display: block
            }
          </style>
          @laravelPWA
    </head>
    <body class="{{ $class ?? '' }} h-100">

        <div id="apps" class="h-100" >
        @auth()
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.navbars.sidebar')
        @endauth
        <div class="main-content">
                    @include('layouts.navbars.navbar')
                    @yield('content')

        </div>

        @guest()
            @include('layouts.footers.guest')
        @endguest
        </div>
        @vite(['resources/js/app.js'])
        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.jqueryui.min.js"></script>
        @stack('js')

        <!-- Argon JS -->

        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>

    </body>
</html>
