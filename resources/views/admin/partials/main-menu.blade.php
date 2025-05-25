<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-sticky navbar-dark navbar-without-dd-arrow"
     role="navigation" data-menu="menu-wrapper">
    <div class="navbar-header d-xl-none d-block">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="#">
                    <div class="brand-logo"><img class="logo" src="{{ asset('images/anardoni-logo.png') }}"
                                                 alt="logo"></div>
                    <h2 class="brand-text mb-0"></h2></a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content" data-menu="menu-container">
        <!-- include ../../includes/mixins-->
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
                    <span>مدیران </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">

                    @can('create')
                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.admin.create') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                ایجاد مدیر
                            </a>
                        </li>
                    @endcan

                    @can('show')
                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.admin.index') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                لیست مدیران
                            </a>
                        </li>
                    @endcan


                </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="bx bx-check-shield"></i>
                    <span> نقش ها </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">

                    @can('create')
                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.role.create') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                ایجاد نقش
                            </a>
                        </li>
                    @endcan

                    @can('show')
                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.role.index') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                لیست نقش ها
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="bx bx-folder"></i>
                    <span>دسته بندی  </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">

                    @can('create')
                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.category.create') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                ایجاد دسته بندی
                            </a>
                        </li>
                    @endcan

                    @can('show')
                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.category.index') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                لیست دسته بندی
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="bx bx-book"></i>
                    <span>راهنما</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">


                    @can('create')
                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.article.create') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                ایجاد راهنما
                            </a>
                        </li>
                    @endcan

                    @can('show')
                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.article.index') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                لیست راهنما
                            </a>
                        </li>
                    @endcan


                </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="bx bx-question-mark"></i>
                    <span> سوالات متداول  </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">

                    @can('create')
                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.faq.create') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                ایجاد سوال متداول
                            </a>
                        </li>
                    @endcan

                    @can('show')
                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.faq.index') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                لیست سوال متداول
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>


            <li class="dropdown nav-item" data-menu="dropdown">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="bx bx-menu"></i>
                    <span> منو اصلی  </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">

                    @can('create')
                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.main_menu.create') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                ایجاد منو
                            </a>
                        </li>
                    @endcan

                    @can('show')
                        <li data-menu="">
                            <a class="dropdown-item align-items-center" href="{{ route('admin.main_menu.index') }}"
                               data-toggle="dropdown">
                                <i class="bx bx-left-arrow-alt"></i>
                                لیست منو
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.profile.index') }}">
                    <i class="bx bx-cog"></i>
                    <span data-i18n="Dashboard">پروفایل</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.logout') }}">
                    <i class="bx bx-exit"></i>
                    <span data-i18n="Dashboard">خروج</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- /horizontal menu content-->
</div>
