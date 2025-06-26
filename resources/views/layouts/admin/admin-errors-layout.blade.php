<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frest/images/ico/favicon.ico') }} ">
    <meta name="theme-color" content="#5A8DEE">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/vendors/vendors.min.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/bootstrap.min.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/bootstrap-extended.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/colors.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/components.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/themes/dark-layout.css') }} ">
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/frest/themes/semi-dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/global.css') }}">
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/global.css') }}">

</head>

<body class="horizontal-layout horizontal-menu navbar-static dark-layout 1-column   footer-static bg-full-screen-image  blank-page blank-page" data-open="hover" data-menu="horizontal-menu" data-col="1-column" data-layout="dark-layout">
@yield('contents')

</body>
</html>
