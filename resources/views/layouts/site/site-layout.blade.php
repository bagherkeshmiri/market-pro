<!DOCTYPE html>
<html lang="fa" dir="rtl">

@include('partials.site.head' , ['pageTitle' => $pageTitle])

<body class="goto-here">

@include('partials.site.menu')

{{ $slot }}

@include('partials.site.footer')

<div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00"/>
    </svg>
</div>

<script type="text/javascript" src="{{ asset('js/site/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery-migrate-3.0.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.easing.1.3.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.waypoints.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.stellar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.magnific-popup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/aos.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.animateNumber.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/scrollax.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/main.js') }}"></script>

@yield('scripts')
@livewireScripts
</body>
</html>
