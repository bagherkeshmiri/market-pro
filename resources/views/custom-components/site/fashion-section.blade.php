<section class="fashion-section pb-50">
    <div class="container rtl">
        <div class="category-top heading-space space-border">
            <div class="section-heading mb-0">
                <h2 class="section-title">{{ $title }}</h2>
            </div>
            <!-- Carousel Arrows -->
            <div class="swiper-arrow">
                <div class="swiper-nav swiper-next"><i class="fa-regular fa-arrow-right"></i></div>
                <div class="swiper-nav swiper-prev"><i class="fa-regular fa-arrow-left"></i></div>
            </div>
        </div>
        <div class="shop-carousel swiper">
            <div class="swiper-wrapper">


                @foreach($items as $item)
                    {{--                    <div class="swiper-slide">--}}
                    {{--                        <div class="shop-item">--}}
                    {{--                            <div class="shop-thumb">--}}
                    {{--                                <div class="overlay"></div>--}}
                    {{--                                <img src="{{ asset('images/site/shop-1.png') }}" alt="shop">--}}
                    {{--                                <span class="sale">جدید</span>--}}
                    {{--                                <ul class="shop-list">--}}
                    {{--                                    <li><a href="#"><i class="fa-regular fa-cart-shopping"></i></a></li>--}}
                    {{--                                    <li><a href="#"><i class="fa-light fa-heart"></i></a></li>--}}
                    {{--                                    <li><a href="#"><i class="fa-light fa-eye"></i></a></li>--}}
                    {{--                                </ul>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="shop-content">--}}
                    {{--                                <span class="category">Levi’s برند</span>--}}
                    {{--                                <h3 class="title"><a href="#">لباس مجلسی مونیکا دیارا</a></h3>--}}
                    {{--                                <div class="review-wrap">--}}
                    {{--                                    <ul class="review">--}}
                    {{--                                        <li><i class="fa-solid fa-star"></i></li>--}}
                    {{--                                        <li><i class="fa-solid fa-star"></i></li>--}}
                    {{--                                        <li><i class="fa-solid fa-star"></i></li>--}}
                    {{--                                        <li><i class="fa-solid fa-star"></i></li>--}}
                    {{--                                        <li><i class="fa-solid fa-star"></i></li>--}}
                    {{--                                    </ul>--}}
                    {{--                                    <span>(15 نظرات)</span>--}}
                    {{--                                </div>--}}
                    {{--                                <span class="price"> <span class="offer">250,000 تومان</span>157,000 تومان</span>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}


                    @include('custom-components.site.product-slider-item', [
                        'title' => $item->product->name,
                        'product' => $item->product,
                        'sampleProductImageUrl' => $sampleProductImageUrl,
                    ])

                @endforeach



                {{--                <div class="swiper-slide">--}}
                {{--                    <div class="shop-item">--}}
                {{--                        <div class="shop-thumb">--}}
                {{--                            <div class="overlay"></div>--}}
                {{--                            <img src="{{ asset('images/site/shop-2.png') }}" alt="shop">--}}
                {{--                            <span class="sale">جدید</span>--}}
                {{--                            <ul class="shop-list">--}}
                {{--                                <li><a href="#"><i class="fa-regular fa-cart-shopping"></i></a></li>--}}
                {{--                                <li><a href="#"><i class="fa-light fa-heart"></i></a></li>--}}
                {{--                                <li><a href="#"><i class="fa-light fa-eye"></i></a></li>--}}
                {{--                            </ul>--}}
                {{--                        </div>--}}
                {{--                        <div class="shop-content">--}}
                {{--                            <span class="category">Levi’s برند</span>--}}
                {{--                            <h3 class="title"><a href="#">صندل گل مشکی اونیما</a></h3>--}}
                {{--                            <div class="review-wrap">--}}
                {{--                                <ul class="review">--}}
                {{--                                    <li><i class="fa-solid fa-star"></i></li>--}}
                {{--                                    <li><i class="fa-solid fa-star"></i></li>--}}
                {{--                                    <li><i class="fa-solid fa-star"></i></li>--}}
                {{--                                    <li><i class="fa-solid fa-star"></i></li>--}}
                {{--                                    <li><i class="fa-solid fa-star"></i></li>--}}
                {{--                                </ul>--}}
                {{--                                <span>(15 نظرات)</span>--}}
                {{--                            </div>--}}
                {{--                            <span class="price"> <span class="offer">450,000 تومان</span>257,000 تومان</span>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="swiper-slide">--}}
                {{--                    <div class="shop-item">--}}
                {{--                        <div class="shop-thumb">--}}
                {{--                            <div class="overlay"></div>--}}
                {{--                            <img src="{{ asset('images/site/shop-3.png') }}" alt="shop">--}}
                {{--                            <span class="sale">جدید</span>--}}
                {{--                            <ul class="shop-list">--}}
                {{--                                <li><a href="#"><i class="fa-regular fa-cart-shopping"></i></a></li>--}}
                {{--                                <li><a href="#"><i class="fa-light fa-heart"></i></a></li>--}}
                {{--                                <li><a href="#"><i class="fa-light fa-eye"></i></a></li>--}}
                {{--                            </ul>--}}
                {{--                        </div>--}}
                {{--                        <div class="shop-content">--}}
                {{--                            <span class="category">Levi’s برند</span>--}}
                {{--                            <h3 class="title"><a href="#">ژاکت پانچو بین المللی</a></h3>--}}
                {{--                            <div class="review-wrap">--}}
                {{--                                <ul class="review">--}}
                {{--                                    <li><i class="fa-solid fa-star"></i></li>--}}
                {{--                                    <li><i class="fa-solid fa-star"></i></li>--}}
                {{--                                    <li><i class="fa-solid fa-star"></i></li>--}}
                {{--                                    <li><i class="fa-solid fa-star"></i></li>--}}
                {{--                                    <li><i class="fa-solid fa-star"></i></li>--}}
                {{--                                </ul>--}}
                {{--                                <span>(15 نظرات)</span>--}}
                {{--                            </div>--}}
                {{--                            <span class="price"> <span class="offer">550,000 تومان</span>427,000 تومان</span>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="swiper-slide">--}}
                {{--                    <div class="shop-item">--}}
                {{--                        <div class="shop-thumb">--}}
                {{--                            <div class="overlay"></div>--}}
                {{--                            <img src="{{ asset('images/site/shop-4.png') }}" alt="shop">--}}
                {{--                            <span class="sale">جدید</span>--}}
                {{--                            <ul class="shop-list">--}}
                {{--                                <li><a href="#"><i class="fa-regular fa-cart-shopping"></i></a></li>--}}
                {{--                                <li><a href="#"><i class="fa-light fa-heart"></i></a></li>--}}
                {{--                                <li><a href="#"><i class="fa-light fa-eye"></i></a></li>--}}
                {{--                            </ul>--}}
                {{--                        </div>--}}
                {{--                        <div class="shop-content">--}}
                {{--                            <span class="category">Levi’s برند</span>--}}
                {{--                            <h3 class="title"><a href="#">کیف پنبه ای اداری ضد آب</a></h3>--}}
                {{--                            <div class="review-wrap">--}}
                {{--                                <ul class="review">--}}
                {{--                                    <li><i class="fa-solid fa-star"></i></li>--}}
                {{--                                    <li><i class="fa-solid fa-star"></i></li>--}}
                {{--                                    <li><i class="fa-solid fa-star"></i></li>--}}
                {{--                                    <li><i class="fa-solid fa-star"></i></li>--}}
                {{--                                    <li><i class="fa-solid fa-star"></i></li>--}}
                {{--                                </ul>--}}
                {{--                                <span>(15 نظرات)</span>--}}
                {{--                            </div>--}}
                {{--                            <span class="price"> <span class="offer">350,000 تومان</span>250,000 تومان</span>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
</section>
