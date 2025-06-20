<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-sticky navbar-dark navbar-without-dd-arrow font-13"
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
                <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
                    <i class="bx bx-home text-white"></i>
                    <span class="text-white" data-i18n="Dashboard" >داشبورد</span>
                </a>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="bx bx-group text-white"></i>
                    <span class="text-white">کاربران </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right ">

                    <li  data-menu="">
                        <a class="dropdown-item align-items-center font-13 text-white" href="{{ route('admin.user.create') }}"
                           data-toggle="dropdown">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            ایجاد کاربر
                        </a>
                    </li>

                    <li data-menu="">
                        <a class="dropdown-item align-items-center font-13 text-white" href="{{ route('admin.user.index') }}"
                           data-toggle="dropdown">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            لیست کاربران
                        </a>
                    </li>


                </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="bx bx-check-shield text-white"></i>
                    <span class="text-white"> نقش ها </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">

                    <li data-menu="">
                        <a class="dropdown-item align-items-center font-13 text-white" href="{{ route('admin.role.create') }}"
                           data-toggle="dropdown">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            ایجاد نقش
                        </a>
                    </li>

                    <li data-menu="">
                        <a class="dropdown-item align-items-center font-13 text-white" href="{{ route('admin.role.index') }}"
                           data-toggle="dropdown">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            لیست نقش ها
                        </a>
                    </li>

                </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="bx bx-folder text-white"></i>
                    <span class="text-white">دسته بندی  </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">

                    <li data-menu="">
                        <a class="dropdown-item align-items-center font-13 text-white" href="{{ route('admin.category.create') }}"
                           data-toggle="dropdown">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            ایجاد دسته بندی
                        </a>
                    </li>

                    <li data-menu="">
                        <a class="dropdown-item align-items-center font-13 text-white" href="{{ route('admin.category.index') }}"
                           data-toggle="dropdown">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            لیست دسته بندی
                        </a>
                    </li>

                </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="bx bx-package text-white"></i>
                    <span class="text-white">محصولات</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">


                    <li data-menu="">
                        <a class="dropdown-item align-items-center font-13 text-white" href="{{ route('admin.product.create') }}"
                           data-toggle="dropdown">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            ایجاد محصول
                        </a>
                    </li>

                    <li data-menu="">
                        <a class="dropdown-item align-items-center font-13 text-white" href="{{ route('admin.product.index') }}"
                           data-toggle="dropdown">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            لیست محصولات
                        </a>
                    </li>


                </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="bx bx-collection text-white"></i>
                    <span class="text-white">کالکشن ها</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">


                    <li data-menu="">
                        <a class="dropdown-item align-items-center font-13 text-white" href="{{ route('admin.collection.create') }}"
                           data-toggle="dropdown">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            ایجاد کالکشن
                        </a>
                    </li>

                    <li data-menu="">
                        <a class="dropdown-item align-items-center font-13 text-white" href="{{ route('admin.collection.index') }}"
                           data-toggle="dropdown">
                            <i class="bx bx-left-arrow-alt"></i>
                            لیست کالکشن ها
                        </a>
                    </li>


                </ul>
            </li>

            <li class="dropdown nav-item" data-menu="dropdown">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="bx bx-money text-white"></i>
                    <span class="text-white">سفارشات</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">


                    <li data-menu="">
                        <a class="dropdown-item align-items-center font-13 text-white" href="#"
                           data-toggle="dropdown">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            سفارش ‌ها امروز
                        </a>
                    </li>

                    <li data-menu="">
                        <a class="dropdown-item align-items-center font-13 text-white" href="#"
                           data-toggle="dropdown">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            لیست سفارش ‌ها
                        </a>
                    </li>


                </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="bx bx-receipt text-white"></i>
                    <span class="text-white">فاکتور ها</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">


                    <li data-menu="">
                        <a class="dropdown-item align-items-center font-13 text-white" href="#"
                           data-toggle="dropdown">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            ایجاد فاکتور
                        </a>
                    </li>

                    <li data-menu="">
                        <a class="dropdown-item align-items-center font-13 text-white" href="#"
                           data-toggle="dropdown">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            لیست فاکتور ها
                        </a>
                    </li>


                </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="bx bx-globe text-white"></i>
                    <span class="text-white"> وب سایت  </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">

                    <li data-menu="">
                        <a class="dropdown-item align-items-center font-13 text-white" href=""
                           data-toggle="dropdown">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            ایجاد منو
                        </a>
                    </li>

                    <li data-menu="">
                        <a class="dropdown-item align-items-center font-13 text-white" href=""
                           data-toggle="dropdown">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            لیست منو
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
    </div>
</div>
