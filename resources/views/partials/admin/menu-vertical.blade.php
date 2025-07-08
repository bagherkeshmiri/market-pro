<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    <div class="brand-logo"><img class="logo" src="{{ asset('images/frest/logo.png') }}" alt=""></div>
                    <h5 class="brand-text mb-0">پیکسل دونی</h5></a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content font-13 ">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
            <li class=" nav-item">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="bx bx-home text-white"></i>
                    <span class="menu-title text-white" data-i18n="dashboard">داشبورد</span>
                </a>
            </li>
            <li class=" nav-item">
                <a href="#">
                    <i class="bx bx-group text-white"></i>
                    <span class="menu-title text-white" data-i18n="users">کاربران</span>
                </a>
                <ul class="menu-content">
                    <li ><a href="{{ route('admin.user.create') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white"  data-i18n="create-user">  ایجاد کاربر</span>
                        </a>
                    </li>

                    <li ><a href="{{ route('admin.user.index') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white"  data-i18n="users-list">   لیست کاربران </span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class=" nav-item">
                <a href="#">
                    <i class="bx bx-check-shield text-white"></i>
                    <span class="menu-title text-white" data-i18n="roles">نقش ها</span>
                </a>
                <ul class="menu-content">
                    <li ><a href="{{ route('admin.role.create') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white"  data-i18n="create-role">  ایجاد نقش</span>
                        </a>
                    </li>

                    <li ><a href="{{ route('admin.role.index') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white"  data-i18n="roles-list">   لیست نقش ها </span>
                        </a>
                    </li>

                </ul>
            </li>


        </ul>
    </div>
</div>
