<!DOCTYPE html>
<html class="no-js" lang="fa">

@include('partials.site.head' , [ 'pageTitle' => $pageTitle,])

<body style="overflow-x: hidden !important; ">

@include('partials.site.menu' , ['searchMenuCategories' => $searchMenuCategories , 'menus' => $menus])

{{ $slot }}

@include('partials.site.footer')


<div id="scroll-percentage"><span id="scroll-percentage-value"></span></div>


<script src="{{ asset('js/site/vendor/jquary-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/site/vendor/bootstrap-bundle.js') }}"></script>
<script src="{{ asset('js/site/vendor/imagesloaded-pkgd.js') }}"></script>
<script src="{{ asset('js/site/vendor/waypoints.min.js') }}"></script>
<script src="{{ asset('js/site/vendor/venobox.min.js') }}"></script>
<script src="{{ asset('js/site/vendor/odometer.min.js') }}"></script>
<script src="{{ asset('js/site/vendor/meanmenu.js') }}"></script>
<script src="{{ asset('js/site/vendor/smooth-scroll.js') }}"></script>
<script src="{{ asset('js/site/vendor/jquery.isotope.js') }}"></script>
<script src="{{ asset('js/site/vendor/wow.min.js') }}"></script>
<script src="{{ asset('js/site/vendor/swiper.min.js') }}"></script>
<script src="{{ asset('js/site/vendor/split-type.min.js') }}"></script>
<script src="{{ asset('js/site/vendor/gsap.min.js') }}"></script>
<script src="{{ asset('js/site/vendor/scroll-trigger.min.js') }}"></script>
<script src="{{ asset('js/site/vendor/countdown.js') }}"></script>
<script src="{{ asset('js/site/vendor/nice-select.js') }}"></script>
<script src="{{ asset('js/site/ajax-form.js') }}"></script>
<script src="{{ asset('js/site/contact.js') }}"></script>
<script src="{{ asset('js/site/main.js') }}"></script>

@yield('scripts')
@livewireScripts

</body>
</html>
