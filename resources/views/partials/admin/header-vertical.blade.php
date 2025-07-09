<div class="header-navbar-shadow"></div>
<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-dark font-13">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon bx bx-menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav">
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-ir"></i>
                            <span class="selected-language text-white">فارسی</span></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag">
                            <a class="dropdown-item text-white" href="#" data-language="fa" aria-label="فارسی">
                                <i class="flag-icon flag-icon-ir mr-50"></i> فارسی
                            </a>
                            <a class="dropdown-item text-white" href="#" data-language="en" aria-label="English">
                                <i class="flag-icon flag-icon-us mr-50"></i> English
                            </a>
                        </div>
                    </li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen text-white"></i></a></li>

                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal text-white"></i><span class="badge badge-pill badge-danger badge-up">5</span></a>

                    </li>
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name" style="color: white !important;">{{ auth()->user()->name  }} </span></div>
                            <span><img class="round" src="{{ asset('images/frest/avatar-s-16.png') }}" alt="avatar" height="40" width="40"></span></a>
                        <div class="dropdown-menu pb-0">
                            <a class="dropdown-item text-white" href="{{ route('admin.profile.index') }}"><i class="bx bx-user mr-50"></i> پروفایل</a>
                            <div class="dropdown-divider mb-0"></div>
                            <a class="dropdown-item text-white" href="{{ route('admin.logout') }}"><i class="bx bx-power-off mr-50"></i> خروج</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
