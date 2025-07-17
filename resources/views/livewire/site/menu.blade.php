<div>
    <header class="header sticky-active rtl">
        <div class="header-middle">
            <div class="container rtl">
                <div class="header-middle-inner">
                    <div class="header-middle-left">
                        <div class="header-logo d-lg-block">
                            <a href="{{ route('site.home') }}">
                                <img src="{{ asset('images/site/logo-1.png') }}" alt="Logo">
                            </a>
                        </div>
                        <div class="category-form-wrap">
                            <div class="nice-select select-control country" tabindex="0">
                                <span class="current"> دسته بندی ها</span>
                                <ul class="list">

                                    @foreach($searchMenuCategories as $searchMenuCategory)
                                        <li data-value="" class="option {{ $loop->first ? 'selected focus' : '' }} ">{{ $searchMenuCategory->name }}</li>
                                    @endforeach

                                </ul>
                            </div>
                            <form class="header-form" action="#">
                                <label for="search" hidden></label>
                                <input class="form-control" type="text" id="search" name="search" placeholder="دنبال چی هستی؟">
                                <button class="submit rr-primary-btn">جستجو کنید</button>
                            </form>
                        </div>
                    </div>
                    <div class="header-middle-right">
                        <ul class="contact-item-list">
                            <li>
                                <div class="content">
                                    <span>تماس با ما:</span>
                                    <a class="number" href="tel:+985112345678">12345678 - 051 </a>
                                </div>
                                <a href="#" class="icon">
                                    <i class="fa-regular fa-phone"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('site.wishlist') }}" class="icon">
                                    <i class="fa-sharp fa-regular fa-heart"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('site.cart') }}" class="icon">
                                    <i class="fa-light fa-bag-shopping"></i>
                                    <span id="cart-count">{{ $cartCount }}</span>
                                </a>
                                <div class="content">
                                    <span>سبد خرید شما</span>
                                    <h5 id="cart-sum" class="number">{{ number_format($cartTotal) }} تومان</h5>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="primary-header">
            <div class="container">
                <div class="primary-header-inner">
                    <div class="header-logo mobile-logo">
                        <a href="{{ route('site.home') }}">
                            <img src="{{ asset('images/site/logo-1.png') }}" alt="Logo">
                        </a>
                    </div>
                    <div class="header-menu-wrap">
                        <div class="mobile-menu-items">
                            <ul>
                                <li class="menu-item-has-children active">
                                    <a href="{{ route('site.home') }}">خانه</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">محصولات</a>
                                    <ul>
                                        @foreach($menus as $menu)
                                            <li><a href="#">{{ $menu->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">پرفروش‌ترین‌ها</a>
                                </li>
                                <li>
                                    <a href="#">جدیدترین‌ها</a>
                                </li>
                                <li>
                                    <a href="#">پیگیری سفارش</a>
                                </li>
                                <li>
                                    <a href="{{ route('site.faq') }}">سوالات متداول</a>
                                </li>
                                <li>
                                    <a href="{{ route('site.blog') }}">وبلاگ</a>
                                </li>

                                <li><a href="{{ route('site.contact') }}">ارتباط با ما</a></li>


                                @guest
                                    <li><a href="{{ route('site.login') }}">ورود</a></li>
                                    <li><a href="{{ route('site.register') }}">عضویت</a></li>
                                @endguest

                                @auth
                                    <li><a href="#">پروفایل من</a></li>
                                @endauth

                            </ul>
                        </div>
                    </div>
                    <div class="header-right-wrap">
                        <div class="header-right">
                            <div class="header-right-item">
                                <a href="javascript:void(0)" class="mobile-side-menu-toggle">
                                    <i class="fa-sharp fa-solid fa-bars"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="mobile-side-menu rtl">
        <div class="side-menu-content">
            <div class="side-menu-head">
                <a href='{{ route('site.home') }}'><img src="{{ asset('images/site/logo-1.png') }}" alt="logo"></a>
                <button class="mobile-side-menu-close"><i class="fa-regular fa-xmark"></i></button>
            </div>
            <div class="side-menu-wrap"></div>
            <ul class="side-menu-list">
                <li><i class="fa-light fa-location-dot"></i>آدرس : <span>تهران ، خیابان گل ، پلاک ۱۲۳</span></li>
                <li><i class="fa-light fa-phone"></i>شماره تماس : <a href="tel:+989127661646">12345678 - 051</a></li>
                <li><i class="fa-light fa-envelope"></i>آدرس ایمیل : <a href="mailto:info@example.com">info@example.com</a></li>
            </ul>
        </div>
    </div>
</div>
