<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    <div class="brand-logo"><img class="logo" src="{{ asset('images/frest/logo.png') }}" alt=""></div>
                    <h5 class="brand-text mb-0">رویسر</h5></a></li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i>
                    <i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content font-13 ">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation"
            data-icon-style="lines">
            <li class=" nav-item {{ isActiveRoute('admin.dashboard') }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="bx bx-home text-white"></i>
                    <span class="menu-title text-white "
                          data-i18n="dashboard">داشبورد</span>
                </a>
            </li>
            <li class=" nav-item {{ isActiveUrl('admin/admin*', 'open') }}">
                <a href="#">
                    <i class="bx bx-group text-white"></i>
                    <span class="menu-title text-white" data-i18n="users">مدیران</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ isActiveRoute('admin.admin.create') }}">
                        <a href="{{ route('admin.admin.create') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="create-user">  ایجاد مدیر</span>
                        </a>
                    </li>

                    <li class="{{ isActiveRoute('admin.admin.index') }}">
                        <a href="{{ route('admin.admin.index') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="users-list">   لیست مدیران </span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item {{ isActiveUrl('admin/admin*', 'open') }}">
                <a href="#">
                    <i class="bx bx-group text-white"></i>
                    <span class="menu-title text-white" data-i18n="users">کاربران</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ isActiveRoute('admin.user.index') }}">
                        <a href="{{ route('admin.user.index') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="users-list">   لیست کاربران </span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item {{ isActiveUrl('admin/admin*', 'open') }}">
                <a href="#">
                    <i class="bx bx-check-shield text-white"></i>
                    <span class="menu-title text-white" data-i18n="roles">نقش ها</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ isActiveRoute('admin.role.create') }}">
                        <a href="{{ route('admin.role.create') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="create-role">  ایجاد نقش</span>
                        </a>
                    </li>

                    <li class="{{ isActiveRoute('admin.role.index') }}">
                        <a href="{{ route('admin.role.index') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="roles-list">   لیست نقش ها </span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item {{ isActiveUrl('admin/admin*', 'open') }}">
                <a href="#">
                    <i class="bx bx-folder text-white"></i>
                    <span class="menu-title text-white" data-i18n="roles">دسته بندی ها</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ isActiveRoute('admin.category.create') }}">
                        <a href="{{ route('admin.category.create') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="create-role">  ایجاد دسته</span>
                        </a>
                    </li>

                    <li class="{{ isActiveRoute('admin.category.index') }}">
                        <a href="{{ route('admin.category.index') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="roles-list">   لیست دسته بندی ها </span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item {{ isActiveUrl('admin/admin*', 'open') }}">
                <a href="#">
                    <i class="bx  bx-package text-white"></i>
                    <span class="menu-title text-white" data-i18n="roles">محصولات</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ isActiveRoute('admin.product.create') }}">
                        <a href="{{ route('admin.product.create') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="create-role">  ایجاد محصول</span>
                        </a>
                    </li>

                    <li class="{{ isActiveRoute('admin.product.index') }}">
                        <a href="{{ route('admin.product.index') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="roles-list">   لیست محصولات </span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item {{ isActiveUrl('admin/admin*', 'open') }}">
                <a href="#">
                    <i class="bx  bx-collection text-white"></i>
                    <span class="menu-title text-white" data-i18n="roles">کالکشن ها</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ isActiveRoute('admin.collection.create') }}">
                        <a href="{{ route('admin.collection.create') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="create-role">  ایجاد کالکشن</span>
                        </a>
                    </li>

                    <li class="{{ isActiveRoute('admin.collection.index') }}">
                        <a href="{{ route('admin.collection.index') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="roles-list">   لیست کالکشن ها </span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item {{ isActiveUrl('admin/admin*', 'open') }}">
                <a href="#">
                    <i class="bx bx-globe text-white"></i>
                    <span class="menu-title text-white" data-i18n="roles">وب سایت </span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="#">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item text-white" data-i18n="Second Level">
                                سوالات متداول
                            </span>
                        </a>
                        <ul class="menu-content">
                            <li class="{{ isActiveRoute('admin.faq.create') }}">
                                <a href="{{ route('admin.faq.create') }}">
                                    <i class="bx bx-left-arrow-alt text-white"></i>
                                    <span class="menu-item text-white" data-i18n="Third Level">
                                        ایجاد سوال
                                    </span>
                                </a>
                            </li>

                            <li class="{{ isActiveRoute('admin.faq.index') }}">
                                <a href="{{ route('admin.faq.index') }}">
                                    <i class="bx bx-left-arrow-alt text-white"></i>
                                    <span class="menu-item text-white" data-i18n="Third Level">
                                         لیست سوالات
                                    </span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item text-white" data-i18n="Second Level">
                                وبلاگ
                            </span>
                        </a>
                        <ul class="menu-content">
                            <li class="{{ isActiveRoute('admin.post.create') }}">
                                <a href="{{ route('admin.post.create') }}">
                                    <i class="bx bx-left-arrow-alt text-white"></i>
                                    <span class="menu-item text-white" data-i18n="Third Level">
                                        ایجاد پست
                                    </span>
                                </a>
                            </li>

                            <li class="{{ isActiveRoute('admin.post.index') }}">
                                <a href="{{ route('admin.post.index') }}">
                                    <i class="bx bx-left-arrow-alt text-white"></i>
                                    <span class="menu-item text-white" data-i18n="Third Level">
                                         لیست پست ها
                                    </span>
                                </a>
                            </li>

                        </ul>
                    </li>
                </ul>
            </li>
            <li class=" nav-item {{ isActiveUrl('admin/admin*', 'open') }}">
                <a href="#">
                    <i class="bx bx-message text-white"></i>
                    <span class="menu-title text-white" data-i18n="roles">نظرات</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ isActiveRoute('admin.comment.index') }}">
                        <a href="{{ route('admin.comment.index') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="roles-list">   لیست نظرات </span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item {{ isActiveUrl('admin/admin*', 'open') }}">
                <a href="#">
                    <i class="bx  bxs-bank text-white"></i>
                    <span class="menu-title text-white" data-i18n="roles"> درگاه ها</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ isActiveRoute('admin.gateway.create') }}">
                        <a href="{{ route('admin.gateway.create') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="create-role">  ایجاد درگاه</span>
                        </a>
                    </li>

                    <li class="{{ isActiveRoute('admin.gateway.index') }}">
                        <a href="{{ route('admin.gateway.index') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="roles-list">   لیست درگاه ها </span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item {{ isActiveUrl('admin/admin*', 'open') }}">
                <a href="#">
                    <i class="bx bx-line-chart text-white"></i>
                    <span class="menu-title text-white" data-i18n="roles">گزارشات</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ isActiveRoute('') }}">
                        <a href="#">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="roles-list">    فروش امروز </span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item {{ isActiveUrl('admin/admin*', 'open') }}">
                <a href="#">
                    <i class="bx   bx-money text-white"></i>
                    <span class="menu-title text-white" data-i18n="roles"> سفارشات</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ isActiveRoute('admin.order.index-today') }}">
                        <a href="{{ route('admin.order.index-today') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="create-role">سفارش ‌های امروز</span>
                        </a>
                    </li>

                    <li class="{{ isActiveRoute('admin.order.index-all') }}">
                        <a href="{{ route('admin.order.index-all') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="roles-list">   لیست سفارش‌ها </span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item {{ isActiveUrl('admin/admin*', 'open') }}">
                <a href="#">
                    <i class="bx bxs-credit-card text-white"></i>
                    <span class="menu-title text-white" data-i18n="roles"> پرداخت ها</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ isActiveRoute('admin.payment.index-today') }}">
                        <a href="{{ route('admin.payment.index-today') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="create-role">پرداخت ‌های امروز</span>
                        </a>
                    </li>

                    <li class="{{ isActiveRoute('admin.payment.index-all') }}">
                        <a href="{{ route('admin.payment.index-all') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="roles-list">   لیست پرداخت ها </span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item {{ isActiveUrl('admin/admin*', 'open') }}">
                <a href="#">
                    <i class="bx bxs-discount text-white"></i>
                    <span class="menu-title text-white" data-i18n="roles">کد تخفیف </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ isActiveRoute('admin.discount.create') }}">
                        <a href="{{ route('admin.discount.create') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="create-role">ایجاد کد تخفیف</span>
                        </a>
                    </li>

                    <li class="{{ isActiveRoute('admin.discount.index') }}">
                        <a href="{{ route('admin.discount.index') }}">
                            <i class="bx bx-left-arrow-alt text-white"></i>
                            <span class="menu-item  text-white" data-i18n="roles-list">   لیست کد های تخفیف  </span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
    </div>
</div>
