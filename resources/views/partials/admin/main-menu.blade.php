<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-sticky navbar-dark navbar-without-dd-arrow"
     role="navigation" data-menu="menu-wrapper">
    <div class="navbar-header d-xl-none d-block">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="#">
                    <div class="brand-logo"><img class="logo" src="{{ asset('images/frest/logo.png') }}"
                                                 alt="logo"></div>
                    <h2 class="brand-text mb-0"></h2></a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="navbar-container main-menu-content" data-menu="menu-container">
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
            <li class=" nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="bx bx-home"></i>
                    <span data-i18n="Dashboard">داشبورد</span>
                </a>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="bx bx-group"></i>
                    <span>کاربران </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">

                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.user.create') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                ایجاد کاربر
                            </a>
                        </li>

                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.user.index') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                لیست کاربران
                            </a>
                        </li>


                </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="bx bx-check-shield"></i>
                    <span> نقش ها </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">

                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.role.create') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                ایجاد نقش
                            </a>
                        </li>

                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.role.index') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                لیست نقش ها
                            </a>
                        </li>

                </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="bx bx-folder"></i>
                    <span>دسته بندی  </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">

                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.category.create') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                ایجاد دسته بندی
                            </a>
                        </li>

                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.category.index') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                لیست دسته بندی
                            </a>
                        </li>

                </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="bx bx-book"></i>
                    <span>محصولات</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">


                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.product.create') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                ایجاد محصول
                            </a>
                        </li>

                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.product.index') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                لیست محصولات
                            </a>
                        </li>


                </ul>
            </li>


            <li class="dropdown nav-item" data-menu="dropdown">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="bx bx-menu"></i>
                    <span> وب سایت  </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">

                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href=""
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                ایجاد منو
                            </a>
                        </li>

                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href=""
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                لیست منو
                            </a>
                        </li>

                </ul>
            </li>
        </ul>
    </div>
</div>
