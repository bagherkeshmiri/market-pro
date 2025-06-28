<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl" dir="rtl">

@include('partials.admin.head')

<body class="horizontal-layout horizontal-menu navbar-static dark-layout 2-columns   footer-static " data-open="hover"
      data-menu="horizontal-menu" data-col="2-columns" data-layout="dark-layout" style="overflow-x: hidden;">
<div class="d-flex position-absolute justify-content-center mx-auto vh-100 vw-100"
     style="background-color: #0000009e; z-index: 999;" id="loading">
    <div class="spinner-border text-success align-self-center" style="width: 3rem; height: 3rem; opacity: 1;"
         role="status">
    </div>
</div>

@include('partials.admin.header')

@include('partials.admin.menu')

{{ $slot }}

@include('partials.admin.footer')

<script src="{{ asset('js/frest/vendors/vendors.min.js') }}"></script>
<script src="{{ asset('js/frest/vendors/ui/jquery.sticky.js') }}"></script>
<script src="{{ asset('js/frest/vendors/ui/prism.min.js') }}"></script>
<script src="{{ asset('js/frest/scripts/configs/horizontal-menu.js') }}"></script>
<script src="{{ asset('js/frest/core/app-menu.js') }}"></script>
<script src="{{ asset('js/frest/core/app.js') }}"></script>
<script src="{{ asset('js/frest/scripts/components.js') }}"></script>
{{--<script src="{{ asset('js/frest/scripts/footer.js') }}"></script>--}}

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
