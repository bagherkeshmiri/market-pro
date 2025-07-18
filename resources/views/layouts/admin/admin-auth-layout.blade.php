<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="rtl" dir="rtl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frest/images/ico/favicon.ico') }}">
    <meta name="theme-color" content="#5A8DEE">

    @vite(['resources/css/admin-auth-app.css', 'resources/js/admin-auth-app.js'])
    @yield('styles')
    @livewireStyles
</head>


<body
    class="horizontal-layout horizontal-menu navbar-static dark-layout 1-column   footer-static   blank-page blank-page"
    data-open="hover" data-menu="horizontal-menu" data-col="1-column" data-layout="dark-layout" style="background-image: url({{ asset('images/frest/auth-bg-dark.jpg') }});">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section id="auth-login" class="row flexbox-container">
                    <div class="col-xl-8 col-11">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">

                                {{ $slot ?? '' }}

                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                    <div class="card-content">
                                        <img class="img-fluid" src="{{ asset('images/frest/login.png') }} "
                                            alt="branding logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

    @yield('scripts')
    @livewireScripts
</body>

</html>
