<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @pagetitle
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ theme_asset('assets') }}/css/bootstrap.css">
    <link rel="stylesheet" href="{{ theme_asset('assets') }}/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ theme_asset('assets') }}/css/app.css">
    <link rel="stylesheet" href="{{ theme_asset('assets') }}/css/pages/auth.css">
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        @yield('theme-content')
    </div>
</body>

</html>
