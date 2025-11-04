<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $pageTitle }}</title>

    {!! SEO::generate() !!}

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/site/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/site/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/odometer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/main.css') }}">


    @yield('styles')
    @livewireStyles

</head>
