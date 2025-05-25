<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') </title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <meta name="theme-color" content="#5A8DEE">
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href=" {{ asset('/frest/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href=" {{ asset('/frest/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href=" {{ asset('/frest/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href=" {{ asset('/frest/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href=" {{ asset('/frest/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href=" {{ asset('/frest/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href=" {{ asset('/frest/css/themes/semi-dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href=" {{ asset('/frest/css/core/menu/menu-types/horizontal-menu.css') }}">

    <style>
        textarea {
            resize: none !important;
        }

        /* custom scrollbar */
        ::-webkit-scrollbar {
            width: 20px;
        }

        ::-webkit-scrollbar-track {
            background-color: inherit;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #d6dee1;
            border-radius: 20px;
            border: 6px solid transparent;
            background-clip: content-box;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #a8bbbf;
        }
    </style>
    @yield('styles')
    @livewireStyles

</head>
