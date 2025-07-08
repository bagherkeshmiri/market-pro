<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    <div class="brand-logo"><img class="logo" src="{{ asset('images/frest/logo.png') }}" alt=""></div>
                    <h5 class="brand-text mb-0" >پیکسل دونی</h5></a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content font-13 ">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
            <li class=" nav-item">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="bx bx-home text-white"></i>
                    <span class="menu-title text-white" data-i18n="Email">داشبورد</span>
                </a>
            </li>
            <li class=" nav-item"><a href="#">
                    <i class="bx bx-group text-white"></i>
                    <span class="menu-title text-white" data-i18n="Invoice">صورتحساب</span></a>
                <ul class="menu-content">
                    <li><a href="app-invoice-list.html"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">لیست صورتحساب ها</span></a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
