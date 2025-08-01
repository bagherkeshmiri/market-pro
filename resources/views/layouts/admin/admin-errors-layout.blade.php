<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frest/images/ico/favicon.ico') }} ">
    <meta name="theme-color" content="#5A8DEE">

</head>

<body class="horizontal-layout horizontal-menu navbar-static dark-layout 1-column   footer-static   blank-page blank-page"
      data-open="hover" data-menu="horizontal-menu" data-col="1-column" data-layout="dark-layout"
        style="background: url({{ asset('images/frest/auth-bg.jpg') }}) no-repeat center center;
	background-size: cover;">
@yield('contents')

</body>
</html>
