<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl" dir="rtl">

@include('admin.partials.head')

<body class="horizontal-layout horizontal-menu navbar-static dark-layout 2-columns   footer-static " data-open="hover"
      data-menu="horizontal-menu" data-col="2-columns" data-layout="dark-layout" style="overflow-x: hidden;">
<div class="d-flex position-absolute justify-content-center mx-auto vh-100 vw-100"
     style="background-color: #0000009e; z-index: 999;" id="loading">
    <div class="spinner-border text-success align-self-center" style="width: 3rem; height: 3rem; opacity: 1;"
         role="status">
    </div>
</div>

@include('admin.partials.header')

@include('admin.partials.main-menu')

{{ $slot }}

@include('admin.partials.footer')

<script src="{{ asset('/frest/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('/frest/fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js') }}"></script>
<script src="{{ asset('/frest/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js') }}"></script>
<script src="{{ asset('/frest/fonts/LivIconsEvo/js/LivIconsEvo.min.js') }}"></script>
<script src="{{ asset('/frest/vendors/js/ui/jquery.sticky.js') }}"></script>
{{--<script src="{{ asset('/frest/vendors/js/extensions/dropzone.min.js') }}"></script>--}}
<script src="{{ asset('/frest/vendors/js/ui/prism.min.js') }}"></script>

<script src="{{ asset('/frest/js/scripts/configs/horizontal-menu.js') }}"></script>
<script src="{{ asset('/frest/js/scripts/configs/vertical-menu-dark.js') }}"></script>
<script src="{{ asset('/frest/js/core/app-menu.js') }}"></script>
<script src="{{ asset('/frest/js/core/app.js') }}"></script>
<script src="{{ asset('/frest/js/scripts/components.js') }}"></script>
<script src="{{ asset('/frest/js/scripts/footer.js') }}"></script>
<script src="{{ asset('/frest/js/scripts/customizer.js') }}"></script>
{{--<script src="{{ asset('/frest/js/scripts/extensions/dropzone.js') }}"></script>--}}

@yield('scripts')
@livewireScripts

<script>
    window.onload = function () {
        let loading = document.getElementById('loading');
        loading.classList.add('hidden');
    };
</script>

</body>
</html>
