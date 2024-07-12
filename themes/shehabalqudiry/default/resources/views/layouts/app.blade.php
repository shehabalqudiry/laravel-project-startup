<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    @pagetitle
    
    <link rel="icon" href="{{ theme_asset('favicon.ico') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ theme_asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ theme_asset('css/app-light.css') }}" id="lightTheme" disabled>
    <link rel="stylesheet" href="{{ theme_asset('css/app-dark.css') }}" id="darkTheme">
    
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ theme_asset('css/simplebar.css') }}">

    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ theme_asset('css/feather.css') }}">

    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ theme_asset('css/daterangepicker.css') }}">
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
</head>

<body class="vertical  dark rtl ">
    <div class="wrapper">

        <!-- Page Heading -->
        

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')
</body>

</html>