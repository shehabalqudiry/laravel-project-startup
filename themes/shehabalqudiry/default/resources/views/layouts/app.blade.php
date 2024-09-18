<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('settings.app_name', 'All Safe Team') }}</title>

    @pagetitle


    <link rel="icon" href="{{ theme_asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ theme_asset('assets/css/bootstrap.css') }}" />

    <link rel="stylesheet" href="{{ theme_asset('assets/vendors/iconly/bold.css') }}" />

    <link rel="stylesheet" href="{{ theme_asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ theme_asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}" />
    <link rel="stylesheet" href="{{ theme_asset('assets/css/app.css') }}" />
    <link rel="stylesheet" href="{{ theme_asset('assets/css/app-dark.css') }}" />
    <link rel="shortcut icon" href="{{ theme_asset('assets/images/favicon.svg') }}" type="image/x-icon" />
</head>

<body class="{{ app()->getLocale() == 'ar' ? 'rtl' : '' }}">
    <div id="app" class="wrapper">
        <!-- Page Heading -->
        @include('layouts._partials.navbar')
        @include('layouts._partials.sidbar')

        <!-- Page Content -->
        <div id="main">
            <div class="page-heading">
                <h3>@yield('page-title')</h3>
            </div>
            <div class="page-content">
                @yield('theme-content')
            </div>
        </div> <!-- .wrapper -->
        @stack('modals')
        <script src="{{ theme_asset('assets/js/dark.js') }}"></script>
        <script src="{{ theme_asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ theme_asset('assets/js/app.js') }}"></script>

        <script src="{{ theme_asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
        <script src="{{ theme_asset('assets/js/pages/dashboard.js') }}"></script>
        {{--  <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-56159088-1');
    </script>  --}}
</body>

</html>
