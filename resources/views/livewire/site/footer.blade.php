<footer class="footer-section bg-grey pt-60">
    <div class="container rtl">
        <div class="footer-items">
            <div class="footer-item">
                <div class="icon">
                    <img src="{{ asset('images/site/footer-1.png') }}" alt="icon">
                </div>
                <div class="content">
                    <h4 class="title">ارسال رایگان</h4>
                    <span>سفارش بالای 200 هزار تومان</span>
                </div>
            </div>
            <div class="footer-item">
                <div class="icon">
                    <img src="{{ asset('images/site/footer-2.png') }}" alt="icon">
                </div>
                <div class="content">
                    <h4 class="title">بازگشت رایگان</h4>
                    <span>سیاست بازگشت رایگان 30 روزه</span>
                </div>
            </div>
            <div class="footer-item">
                <div class="icon">
                    <img src="{{ asset('images/site/footer-3.png') }}" alt="icon">
                </div>
                <div class="content">
                    <h4 class="title">پرداخت های امن</h4>
                    <span>تمام کارت های عضو شبکه شتاب</span>
                </div>
            </div>
            <div class="footer-item item-2">
                <div class="icon">
                    <img src="{{ asset('images/site/footer-4.png') }}" alt="icon">
                </div>
                <div class="content">
                    <h4 class="title">خدمات مشتری</h4>
                    <span>خدمات مشتری 24/7 </span>
                </div>
            </div>
        </div>
        <div class="row footer-widget-wrap pb-60">
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <div class="widget-header">
                        <h3 class="widget-title"> تماس با ما</h3>
                    </div>
                    <div class="footer-contact">
                        <div class="icon"><i class="fa-sharp fa-solid fa-phone-rotary"></i></div>
                        <div class="content">
                            <span>سوالی دارید؟  با ما تماس بگیرید</span>
                            <a href="tel:+989127661646">12345678 - 051</a>
                        </div>
                    </div>
                    <ul class="schedule-list">
                        <li><span> ساعات کاری :</span> {{ $siteWorkingHour }}</li>
                        <li><span>ایمیل : </span>{{ $siteEmail }}</li>
                        <li><span>آدرس :</span> {{ $siteAddress }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="footer-widget">
                    <div class="widget-header">
                        <h3 class="widget-title">درباره ما</h3>
                    </div>
                    <ul class="footer-list">
                        <li><a href="#">درباره فروشگاه</a></li>
                        <li><a href="{{ route('site.contact') }}"> ارتباط با ما</a></li>
                        <li><a href="{{ route('site.blog') }}"> وبلاگ</a></li>
                        <li><a href="#"> فرصت های شغلی</a></li>
                        <li><a href="#">‌همکاری با ما</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="footer-widget">
                    <div class="widget-header">
                        <h3 class="widget-title"> خدمات مشتریان</h3>
                    </div>
                    <ul class="footer-list">
                        <li><a href="#">راهنمای خرید</a></li>
                        <li><a href="{{ route('site.faq') }}">سوالات متداول</a></li>
                        <li><a href="#">قوانین و مقررات</a></li>
                        <li><a href="#">پیگیری سفارش</a></li>
                        <li><a href="#">بازگشت کالا</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="footer-widget">
                    <div class="widget-header">
                        <h3 class="widget-title">دسته‌بندی‌های محبوب</h3>
                    </div>
                    <ul class="footer-list">
                        <li><a href="#">لباس زنانه</a></li>
                        <li><a href="#">لباس مردانه</a></li>
                        <li><a href="#">لباس بچه گانه</a></li>
                        <li><a href="#">کفش و کتانی</a></li>
                        <li><a href="#">اکسسوری</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <div class="widget-header">
                        <h3 class="widget-title">خبرنامه ما</h3>
                    </div>
                    <div class="news-form-wrap">
                        <p class="mb-20">برای دریافت جدیدترین تخفیف ‌ها، در فهرست پستی مشترک شوید</p>
                        <div class="footer-form mb-20">
                            <form class="rr-subscribe-form">
                                <input class="form-control" type="email" name="email" placeholder="آدرس ایمیل">
                                <input type="hidden" name="action" value="mailchimpsubscribe">
                                <button class="submit">عضویت</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6 mx-auto text-center px-3 pb-4">
            <span>
                    کپی رایت &copy;
                <script>
                        const today = new Date();
                        const faYear = new Intl.DateTimeFormat('fa-IR-u-ca-persian', {year: 'numeric'}).format(today);
                        document.write(faYear);
                </script>
                    - 1400
                    |
                تمامی حقوق برای فروشگاه {{ $siteTitle }}  محفوظ است
            </span>
        </div>
    </div>


</footer>
