<!doctype html>
<html lang="en" dir="rtl" class="h-100">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index"/>
    {!! SEO::generate() !!}
    <title>  @yield('title') | اناردونی</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href=" {{ asset('/frest/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frest/css/font/primary-yekan.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/main.css') }}">
    <link href="{{ asset('site/css/sticky-footer-navbar.rtl.css') }}" rel="stylesheet">

    @yield('styles')
    @livewireStyles

</head>

<body class="d-flex flex-column h-100">

<header>
    @include('layouts.site.nav-bar')
</header>

<div class="row m-0">
    <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 d-none d-sm-none d-sm-none d-md-none d-lg-block d-xl-block"
         style="padding-top: 50px;">
        @yield('side-menu')
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8"
         style="margin-top:50px; margin-bottom: 30px; padding-right: 0; ">
        <!-- Begin page content -->
        <main role="main" class="flex-shrink-0">

            <div class="row mx-auto">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="container ">
                        <!-- BEGIN: Content-->
                    {{ $slot }}
                    <!-- END: Content-->
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

@include('layouts.site.footer')

<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

@yield('scripts')
@livewireScripts

</body>
</html>
