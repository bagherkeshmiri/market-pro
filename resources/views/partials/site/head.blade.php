<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>{{ $pageTitle }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/site/favicon.png') }}">

    @vite(['resources/css/site-app.css', 'resources/js/site-app.js'])
    @yield('styles')
    @livewireStyles
</head>
