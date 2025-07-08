<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top bg-primary navbar-brand-center">
    <div class="navbar-header d-xl-block d-none">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item">
                <a class="navbar-brand" href="">
                    <h2 class="brand-text mb-0">پیکسل دونی</h2>
                </a>
            </li>
        </ul>
    </div>
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu mr-auto"><a class="nav-link nav-menu-main menu-toggle" href="#"><i
                                    class="bx bx-menu"></i></a></li>
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right d-flex align-items-center font-13">
                    <li class="dropdown dropdown-language nav-item">
                        <a class="dropdown-toggle nav-link"
                           id="dropdown-flag" href="#"
                           data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <i class="flag-icon flag-icon-ir"></i>
                            <span class="selected-language d-lg-inline d-none">
                                فارسی
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag">
                            <a class="dropdown-item" href="#" data-language="fa" aria-label="فارسی">
                                <i class="flag-icon flag-icon-ir mr-50"></i> فارسی
                            </a>
                            <a class="dropdown-item" href="#" data-language="en" aria-label="English">
                                <i class="flag-icon flag-icon-us mr-50"></i> English
                            </a>
                        </div>
                    </li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i
                                class="ficon bx bx-fullscreen"></i></a></li>
                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#"
                                                                           data-toggle="dropdown"><i
                                class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span
                                class="badge badge-pill badge-danger badge-up">2</span></a>
                        <ul class="dropdown-menu dropdown-menu-media">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span
                                        class="notification-title">2 اعلان جدید</span><span
                                        class="text-bold-400 cursor-pointer">علامت خوانده شده به همه</span></div>
                            </li>
                            <li class="scrollable-container media-list"><a class="d-flex justify-content-between"
                                                                           href="javascript:void(0)">
                                    <div class="media d-flex align-items-center">
                                        <div class="media-left pr-0">
                                            <div class="avatar mr-1 m-0"><img
                                                    src="{{ asset('images/frest/avatar-s-16.png') }}"
                                                    alt="avatar" height="39" width="39"></div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading"><span class="text-bold-500">تبریک بابت دریافت جوایز</span>
                                                در مسابقات سالانه</h6><small class="notification-text">15 اردیبهشت 12:32
                                                ب.ظ</small>
                                        </div>
                                    </div>
                                </a>
                                <div class="d-flex justify-content-between read-notification cursor-pointer">
                                    <div class="media d-flex align-items-center">
                                        <div class="media-left pr-0">
                                            <div class="avatar mr-1 m-0"><img
                                                    src="{{ asset('images/frest/avatar-s-16.png')  }}"
                                                    alt="avatar" height="39" width="39"></div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading"><span class="text-bold-500">پیام جدید</span>
                                                دریافت شد</h6><small class="notification-text">شما 18 پیام خوانده نشده
                                                دارید</small>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown-menu-footer"><a
                                    class="dropdown-item p-50 text-primary justify-content-center"
                                    href="javascript:void(0)">خواندن همه اعلان ها</a></li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link"
                           href="#" data-toggle="dropdown">
                            <div class="user-nav d-lg-flex d-none"><span
                                    class="user-name">{{ auth()->user()->name  }}</span><span
                                    class="user-status"></span></div>
                            <span>
                                <img class="round" src="{{ asset('images/frest/avatar-s-16.png') }}"
                                     alt="avatar" height="40" width="40">
                            </span>
                        </a>
                                                <div class="dropdown-menu pb-0">
                                                    <a class="dropdown-item text-white" href="{{ route('admin.profile.index') }}">
                                                        <i class="bx bx-user mr-50"></i>
                                                         پروفایل
                                                    </a>
                                                    <div class="dropdown-divider mb-0"></div>
                                                    <a class="dropdown-item text-white" href="{{ route('admin.logout') }}">
                                                        <i class="bx bx-power-off mr-50"></i>
                                                        خروج
                                                    </a>
                                                </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
