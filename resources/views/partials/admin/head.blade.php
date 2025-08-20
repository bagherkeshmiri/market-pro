<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frest/images/ico/favicon.ico') }}">
    <meta name="theme-color" content="#5A8DEE">


    <link rel="stylesheet" href="{{ asset('css/frest/ck-editor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frest/vendors/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frest/vendors/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frest/vendors/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frest/vendors/pickers/datepicker-jalali/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frest/vendors/ui/prism.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frest/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frest/bootstrap-extended.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frest/colors.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frest/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frest/themes/dark-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frest/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frest/pages/widgets.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frest/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frest/vendors/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frest/vendors/extensions/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frest/plugins/extensions/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frest/pages/page-user-profile.css') }}">


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
