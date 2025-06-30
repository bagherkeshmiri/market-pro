@section('styles')
@endsection


<div>
    <section class="hero-section">
        <div class="overlay"></div>
        <div class="hero-images">
            <div class="hero-people"><img src="{{ asset('images/site/hero-peoples.png') }}" alt="img"></div>
            <div class="hero-shape"><img src="{{ asset('images/site/hero-shape-1.png') }}" alt="shape"></div>
            <div class="hero-shape-2"><img src="{{ asset('images/site/hero-shape-2.png') }}" alt="shape"></div>
        </div>
        <div class="container rtl">
            <div class="row">
                <div class="col-xl-8"></div>
                <div class="col-xl-4 col-lg-12">
                    <div class="hero-content">
                        <h4 class="sub-title">کالکشن فصل برند های روز</h4>
                        <h2 class="title">مجموعه فوق‌العاده <br>برای زنان</h2>
                        <h5 class="price"><span> شروع از </span>500.000 تومان</h5>
                        <a href="#" class="rr-primary-btn">مشاهده کالکشن</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="category-section pt-100 pb-100">
        <div class="container rtl">
            <div class="category-top heading-space space-border">
                <div class="section-heading mb-0">
                    <h2 class="section-title">بهترین برای دسته های شما</h2>
                    <p>بیش از 29 دسته بندی و هزاران محصول </p>
                </div>
                <!-- Carousel Arrows -->
                <div class="swiper-arrow">
                    <div class="swiper-nav swiper-next"><i class="fa-regular fa-arrow-right"></i></div>
                    <div class="swiper-nav swiper-prev"><i class="fa-regular fa-arrow-left"></i></div>
                </div>
            </div>
            <div class="category-carousel swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="category-item">
                            <div class="category-img">
                                <img src="{{ asset('images/site/cate-1.png') }}" alt="category">
                            </div>
                            <h3 class="title"><a href="#">پوشاک زنانه</a></h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="category-item">
                            <div class="category-img">
                                <img src="{{ asset('images/site/cate-2.png') }}" alt="category">
                            </div>
                            <h3 class="title"><a href="#">کالکشن کفش</a></h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="category-item">
                            <div class="category-img">
                                <img src="{{ asset('images/site/cate-3.png') }}" alt="category">
                            </div>
                            <h3 class="title"><a href="#">کالکشن کیف</a></h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="category-item">
                            <div class="category-img">
                                <img src="{{ asset('images/site/cate-4.png') }}" alt="category">
                            </div>
                            <h3 class="title"><a href="#">مجموعه ساعت</a></h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="category-item">
                            <div class="category-img">
                                <img src="{{ asset('images/site/cate-5.png') }}" alt="category">
                            </div>
                            <h3 class="title"><a href="#">تجهیزات جانبی</a></h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="category-item">
                            <div class="category-img">
                                <img src="{{ asset('images/site/cate-6.png') }}" alt="category">
                            </div>
                            <h3 class="title"><a href="#">عینک آفتابی</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="discount-section overflow-hidden pb-100 rtl">
        <div class="row gy-lg-0 gy-4">
            <div class="col-lg-4 col-md-6">
                <div class="discount-item item-1">
                    <div class="product-overlay"></div>
                    <div class="shape"><img src="{{ asset('images/site/dis-shape.png') }}" alt="shape"></div>
                    <div class="content">
                        <span>50% تخفیف ویژه</span>
                        <h3 class="title">آخرین ترندهای مردانه <br> این فصل</h3>
                        <a href="#"><i class="fa-regular fa-plus"></i>مشاهده کالکشن</a>
                    </div>
                    <div class="men"><img src="{{ asset('images/site/discount-men-1.png') }}" alt="img"></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="discount-item">
                    <div class="product-overlay"></div>
                    <div class="shape"><img src="{{ asset('images/site/dis-shape.png') }}" alt="shape"></div>
                    <div class="men"><img src="{{ asset('images/site/discount-men-2.png') }}" alt="img"></div>
                    <div class="content">
                        <span>50% تخفیف ویژه</span>
                        <h3 class="title">جدیدترین پوشاک گودکان <br>در این فصل</h3>
                        <a href="#"><i class="fa-regular fa-plus"></i>مشاهده کالکشن</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="discount-item">
                    <div class="product-overlay"></div>
                    <div class="shape"><img src="{{ asset('images/site/dis-shape.png') }}" alt="shape"></div>
                    <div class="men"><img src="{{ asset('images/site/discount-men-3.png') }}" alt="img"></div>
                    <div class="content">
                        <span>50% تخفیف ویژه</span>
                        <h3 class="title">آخرین مد های زنانه <br>فصل جدید</h3>
                        <a href="#"><i class="fa-regular fa-plus"></i>مشاهده کالکشن</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./ discount-section -->

    <section class="fashion-section pb-100">
        <div class="container rtl">
            <div class="category-top heading-space space-border">
                <div class="section-heading mb-0">
                    <h2 class="section-title">استایل مورد علاقتو ببین</h2>
                    <p>بیش از 29 دسته بندی و هزاران محصول</p>
                </div>
                <!-- Carousel Arrows -->
                <div class="swiper-arrow">
                    <div class="swiper-nav swiper-next"><i class="fa-regular fa-arrow-right"></i></div>
                    <div class="swiper-nav swiper-prev"><i class="fa-regular fa-arrow-left"></i></div>
                </div>
            </div>
            <div class="shop-carousel swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="shop-item">
                            <div class="shop-thumb">
                                <div class="overlay"></div>
                                <img src="{{ asset('images/site/shop-1.png') }}" alt="shop">
                                <span class="sale">جدید</span>
                                <ul class="shop-list">
                                    <li><a href="#"><i class="fa-regular fa-cart-shopping"></i></a></li>
                                    <li><a href="#"><i class="fa-light fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa-light fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="shop-content">
                                <span class="category">Levi’s برند</span>
                                <h3 class="title"><a href="#">لباس مجلسی مونیکا دیارا</a></h3>
                                <div class="review-wrap">
                                    <ul class="review">
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                    </ul>
                                    <span>(15 نظرات)</span>
                                </div>
                                <span class="price"> <span class="offer">250.000 تومان</span>157.000 تومان</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-item">
                            <div class="shop-thumb">
                                <div class="overlay"></div>
                                <img src="{{ asset('images/site/shop-2.png') }}" alt="shop">
                                <span class="sale">جدید</span>
                                <ul class="shop-list">
                                    <li><a href="#"><i class="fa-regular fa-cart-shopping"></i></a></li>
                                    <li><a href="#"><i class="fa-light fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa-light fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="shop-content">
                                <span class="category">Levi’s برند</span>
                                <h3 class="title"><a href="#">صندل گل مشکی اونیما</a></h3>
                                <div class="review-wrap">
                                    <ul class="review">
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                    </ul>
                                    <span>(15 نظرات)</span>
                                </div>
                                <span class="price"> <span class="offer">450.000 تومان</span>257.000 تومان</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-item">
                            <div class="shop-thumb">
                                <div class="overlay"></div>
                                <img src="{{ asset('images/site/shop-3.png') }}" alt="shop">
                                <span class="sale">جدید</span>
                                <ul class="shop-list">
                                    <li><a href="#"><i class="fa-regular fa-cart-shopping"></i></a></li>
                                    <li><a href="#"><i class="fa-light fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa-light fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="shop-content">
                                <span class="category">Levi’s برند</span>
                                <h3 class="title"><a href="#">ژاکت پانچو بین المللی</a></h3>
                                <div class="review-wrap">
                                    <ul class="review">
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                    </ul>
                                    <span>(15 نظرات)</span>
                                </div>
                                <span class="price"> <span class="offer">550.000 تومان</span>427.000 تومان</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-item">
                            <div class="shop-thumb">
                                <div class="overlay"></div>
                                <img src="{{ asset('images/site/shop-4.png') }}" alt="shop">
                                <span class="sale">جدید</span>
                                <ul class="shop-list">
                                    <li><a href="#"><i class="fa-regular fa-cart-shopping"></i></a></li>
                                    <li><a href="#"><i class="fa-light fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa-light fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="shop-content">
                                <span class="category">Levi’s برند</span>
                                <h3 class="title"><a href="#">کیف پنبه ای اداری ضد آب</a></h3>
                                <div class="review-wrap">
                                    <ul class="review">
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                    </ul>
                                    <span>(15 نظرات)</span>
                                </div>
                                <span class="price"> <span class="offer">350.000 تومان</span>250.000 تومان</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./ fashion-section -->

    <section class="collect-section pb-100">
        <div class="container rtl">
            <div class="row gy-lg-0 gy-4">
                <div class="col-lg-6">
                    <div class="collect-item">
                        <span>+1500 محصول</span>
                        <h3 class="title">مجموعه زنان</h3>
                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ <br> لورم ایپسوم متن ساختگی با</p>
                        <ul class="collect-list">
                            <li><a href="#">بلیزر</a></li>
                            <li><a href="#">بلوز و پیراهن</a></li>
                            <li><a href="#">کلاه مجلسی</a></li>
                            <li><a href="#">شولوار جین</a></li>
                            <li><a href="#">بافتنی</a></li>
                            <li><a href="#">شلوار</a></li>
                            <li><a href="#">دامن</a></li>
                            <li><a href="#">کت و شلوار</a></li>
                            <li><a href="#">سویشرت و هودی</a></li>
                            <li><a href="#">تی شرت</a></li>
                            <li><a href="#">تاپ و بادی</a></li>
                        </ul>
                        <div class="men"><img src="{{ asset('images/site/discount-1.png') }}" alt="discount"></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="collect-items">
                        <div class="collect-item item-1">
                            <span>+1500 محصول</span>
                            <h3 class="title">کالکشن مردانه</h3>
                            <ul class="collect-list">
                                <li><a href="#">بلیزر</a></li>
                                <li><a href="#">بلوز و پیراهن</a></li>
                                <li><a href="#">کلاه</a></li>
                                <li><a href="#">شلوار جین</a></li>
                            </ul>
                            <div class="men"><img src="{{ asset('images/site/discount-2.png') }}" alt="discount"></div>
                        </div>
                        <div class="collect-item item-2">
                            <span>+1500 محصول</span>
                            <h3 class="title">بهترین اکسسوری</h3>
                            <ul class="collect-list">
                                <li><a href="#">بلیزر</a></li>
                                <li><a href="#">بلوز و پیراهن</a></li>
                                <li><a href="#">کلاه</a></li>
                                <li><a href="#">شلوار جین</a></li>
                            </ul>
                            <div class="men"><img src="{{ asset('images/site/discount-3.png') }}" alt="discount"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./ collect-section -->

    <section class="cta-section pt-100 pb-100" data-background="{{ asset('images/site/cta-bg.jpg') }}">
        <div class="overlay"></div>
        <div class="container">
            <div class="cta-wrap text-center">
                <span>مجموعه زنانه بهار تابستان 22</span>
                <h2 class="title">-15% تخفیف <br>همه اینجا</h2>
                <a href="#" class="rr-primary-btn cta-btn">مشاهده مجموعه ها</a>
            </div>
        </div>
    </section>
    <!-- ./ cta-section -->

    <div class="sponsor-section pt-100">
        <div class="container">
            <div class="row sponsor-wrap">
                <div class="sponsor-item bd-right bd-bottom">
                    <a href="#"><img src="{{ asset('images/site/sponsor-1.png') }}" alt="img"></a>
                </div>
                <div class="sponsor-item bd-right bd-bottom">
                    <a href="#"><img src="{{ asset('images/site/sponsor-2.png') }}" alt="img"></a>
                </div>
                <div class="sponsor-item bd-right bd-bottom">
                    <a href="#"><img src="{{ asset('images/site/sponsor-3.png') }}" alt="img"></a>
                </div>
                <div class="sponsor-item bd-right bd-bottom">
                    <a href="#"><img src="{{ asset('images/site/sponsor-4.png') }}" alt="img"></a>
                </div>
                <div class="sponsor-item bd-bottom">
                    <a href="#"><img src="{{ asset('images/site/sponsor-5.png') }}" alt="img"></a>
                </div>
                <div class="sponsor-item bd-right">
                    <a href="#"><img src="{{ asset('images/site/sponsor-6.png') }}" alt="img"></a>
                </div>
                <div class="sponsor-item bd-right">
                    <a href="#"><img src="{{ asset('images/site/sponsor-7.png') }}" alt="img"></a>
                </div>
                <div class="sponsor-item bd-right">
                    <a href="#"><img src="{{ asset('images/site/sponsor-8.png') }}" alt="img"></a>
                </div>
                <div class="sponsor-item bd-right">
                    <a href="#"><img src="{{ asset('images/site/sponsor-9.png') }}" alt="img"></a>
                </div>
                <div class="sponsor-item">
                    <a href="#"><img src="{{ asset('images/site/sponsor-10.png') }}" alt="img"></a>
                </div>
            </div>
        </div>
    </div>
    <!-- ./ sponsor-section -->

    <section class="deal-section pt-100 pb-100">
        <div class="container rtl">
            <div class="row deal-wrap align-items-center">
                <div class="shape"><img src="{{ asset('images/site/deal-shape.png') }}" alt="shape"></div>
                <div class="col-xl-5 col-lg-12">
                    <div class="deal-content">
                        <div class="section-heading mb-0">
                            <h2 class="section-title">پیشنهادها امروز</h2>
                            <p>طرح اوریگامی صورتی شیک سه نوع نمای بعدی و <br>همکاری دکوراسیون عالی برای افزودن وسایل تزئینی...</p>
                        </div>
                        <div class="deal-info">
                            <div class="icon">
                                <img src="{{ asset('images/site/deal-icon.png') }}" alt="icon">
                            </div>
                            <div class="content">
                                <p>پیشنهاد زمان محدود قرارداد منقضی خواهد شد <br> یک 18 اوت 2024 </p>
                            </div>
                        </div>
                        <a href="#" class="rr-primary-btn deal-btn">مشاهده همه مجموعه ها</a>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-12">
                    <div class="row gy-md-0 gy-4">
                        <div class="col-md-6">
                            <div class="shop-item deal-shop">
                                <div class="shop-thumb">
                                    <div class="overlay"></div>
                                    <img src="{{ asset('images/site/shop-5.jpg') }}" alt="shop">
                                    <span class="sale">جدید</span>
                                    <ul class="shop-list">
                                        <li><a href="#"><i class="fa-regular fa-cart-shopping"></i></a></li>
                                        <li><a href="#"><i class="fa-light fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa-light fa-eye"></i></a></li>
                                    </ul>
                                </div>
                                <div class="shop-content">
                                    <span class="category">Levi’s برند</span>
                                    <h3 class="title"><a href="#">لباس مجلسی مونیکا دیارا</a></h3>
                                    <div class="review-wrap">
                                        <ul class="review">
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                        </ul>
                                        <span>(15 نظرات)</span>
                                    </div>
                                    <span class="price"> <span class="offer">250.000 تومان</span>157.000 تومان</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="shop-item deal-shop">
                                <div class="shop-thumb">
                                    <div class="overlay"></div>
                                    <img src="{{ asset('images/site/shop-6.jpg') }}" alt="shop">
                                    <span class="sale">جدید</span>
                                    <ul class="shop-list">
                                        <li><a href="#"><i class="fa-regular fa-cart-shopping"></i></a></li>
                                        <li><a href="#"><i class="fa-light fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa-light fa-eye"></i></a></li>
                                    </ul>
                                </div>
                                <div class="shop-content">
                                    <span class="category">Levi’s برند</span>
                                    <h3 class="title"><a href="#">صندل گل مشکی اونیما</a></h3>
                                    <div class="review-wrap">
                                        <ul class="review">
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                        </ul>
                                        <span>(15 نظرات)</span>
                                    </div>
                                    <span class="price"> <span class="offer">520.000 تومان</span>257.000 تومان</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./ deal-section -->

    <section class="blog-section pb-100">
        <div class="container rtl">
            <div class="section-heading text-center">
                <h2 class="section-title mb-0">آخرین‌ اخبار ما</h2>
            </div>
            <div class="row gy-lg-0 gy-4 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="post-card">
                        <div class="post-thumb">
                            <img src="{{ asset('images/site/post-1.jpg') }}" alt="post">
                        </div>
                        <div class="post-content-wrap">
                            <div class="post-content">
                                <ul class="post-meta">
                                    <li><i class="fa-sharp fa-solid fa-calendar-days"></i>3 نظر</li>
                                    <li><i class="fa-regular fa-tag"></i>اخبار روز</li>
                                </ul>
                                <h3 class="title"><a href="#">مد در اطراف: بررسی تأثیرات فرهنگی</a></h3>
                            </div>
                            <div class="post-bottom">
                                <a href="#" class="read-more">بیشتر بدانید<i class="fa-regular fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="post-card">
                        <div class="post-thumb">
                            <img src="{{ asset('images/site/post-2.jpg') }}" alt="post">
                        </div>
                        <div class="post-content-wrap">
                            <div class="post-content">
                                <ul class="post-meta">
                                    <li><i class="fa-sharp fa-solid fa-calendar-days"></i>3 نظر</li>
                                    <li><i class="fa-regular fa-tag"></i>اخبار روز</li>
                                </ul>
                                <h3 class="title"><a href="#">پذیرش مد اخلاقی و سازگار با محیط زیست</a></h3>
                            </div>
                            <div class="post-bottom">
                                <a href="#" class="read-more">بیشتر بدانید<i class="fa-regular fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="post-card">
                        <div class="post-thumb">
                            <img src="{{ asset('images/site/post-3.jpg') }}" alt="post">
                        </div>
                        <div class="post-content-wrap">
                            <div class="post-content">
                                <ul class="post-meta">
                                    <li><i class="fa-sharp fa-solid fa-calendar-days"></i>3 نظر</li>
                                    <li><i class="fa-regular fa-tag"></i>اخبار روز</li>
                                </ul>
                                <h3 class="title"><a href="#">چگونه ماشین خود را برای هالووین تزئین کنیم</a></h3>
                            </div>
                            <div class="post-bottom">
                                <a href="#" class="read-more">بیشتر بدانید<i class="fa-regular fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./ blog-section -->
</div>





@section('scripts')
@endsection
