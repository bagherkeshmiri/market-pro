<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl" dir="rtl">

@include('partials.admin.head')

<body class="vertical-layout vertical-menu-modern dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">

@include('partials.admin.header-vertical')


@include('partials.admin.menu-vertical')

{{ $slot }}


@include('partials.admin.footer-vertical')

<script src="{{ asset('js/frest/vendors/vendors.min.js') }}"></script>
<script src="{{ asset('js/frest/vendors/ui/jquery.sticky.js') }}"></script>
<script src="{{ asset('js/frest/vendors/ui/prism.min.js') }}"></script>
<script src="{{ asset('js/frest/vendors/extensions/dragula.min.js') }}"></script>
<script src="{{ asset('js/frest/scripts/configs/vertical-menu-dark.js') }}"></script>
<script src="{{ asset('js/frest/core/app-menu.js') }}"></script>
<script src="{{ asset('js/frest/core/app.js') }}"></script>
<script src="{{ asset('js/frest/scripts/components.js') }}"></script>
<script src="{{ asset('js/frest/scripts/footer.js') }}"></script>
<script src="{{ asset('js/frest/scripts/extensions/drag-drop.js') }}"></script>

</body>
</html>
