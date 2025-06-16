<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="rtl" dir="rtl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') </title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frest/images/ico/favicon.ico') }}">
    <meta name="theme-color" content="#5A8DEE">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/vendors/vendors.min.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/bootstrap.min.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/bootstrap-extended.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/colors.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/components.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/themes/dark-layout.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/themes/semi-dark-layout.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/core/menu/menu-types/horizontal-menu.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/pages/authentication.css') }} ">
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/global.css') }}">

    @yield('styles')
    @livewireStyles
</head>


<body
    class="horizontal-layout horizontal-menu navbar-static dark-layout 1-column   footer-static bg-full-screen-image  blank-page blank-page"
    data-open="hover" data-menu="horizontal-menu" data-col="1-column" data-layout="dark-layout">
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


    <script src="{{ asset('js/frest/vendors/vendors.min.js') }} "></script>
    <script src="{{ asset('js/frest/vendors/ui/jquery.sticky.js') }} "></script>
    <script src="{{ asset('js/frest/scripts/configs/horizontal-menu.js') }} "></script>
    <script src="{{ asset('js/frest/core/app-menu.js') }} "></script>
    <script src="{{ asset('js/frest/core/app.js') }} "></script>
    <script src="{{ asset('js/frest/scripts/components.js') }}"></script>
    <script src="{{ asset('js/frest/scripts/footer.js') }} "></script>


    @yield('scripts')
    @livewireScripts
</body>

</html>
