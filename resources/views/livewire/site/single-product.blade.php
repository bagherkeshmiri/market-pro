@section('styles')

    <style>


        .quantity-selector {
            display: inline-flex;
            align-items: center;
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 0 0 1px #ddd;
        }

        .qty-btn {
            background: #f44336;
            color: #fff;
            border: none;
            padding: 10px 14px;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .qty-btn:hover {
            background: #d32f2f;
        }

        #qty-input {
            width: 60px;
            padding: 10px;
            font-size: 16px;
            text-align: center;
            border: none;
            outline: none;
            background-color: #fff;
            color: #000;
            font-family: inherit;
        }


        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        .product-description table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
        }

        .product-description th,
        .product-description td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

    </style>

@endsection

<div>
    <section class="shop-section single pt-100 pb-100">
        <div class="container rtl">
            <div class="row">
                <div class="col-lg-6 product-details-wrap">
                    <div class="product-slider-wrap">
                        <div class="swiper product-gallary-thumb">
                            <div class="swiper-wrapper">

                                @forelse($product->galleryImages as $imageGallery)

                                    <div class="swiper-slide">
                                        <div class="thumb-item">
                                            <img src="{{ $imageGallery->url }}" alt="">
                                        </div>
                                    </div>

                                @empty

                                    <div class="swiper-slide">
                                        <div class="thumb-item">
                                            <img src="{{ $product->mainImage ? asset($product->mainImage->url) : asset($sampleProductImageUrl) }}" alt="">
                                        </div>
                                    </div>

                                @endforelse

                            </div>
                        </div>
                        <div class="swiper product-gallary">
                            @if($product->status ==  \App\Enums\ProductStatus::Exist && $product->discount > 0)
                                <span class="sale">{{ $product->discount_percent }} %</span>
                            @endif
                            <div class="swiper-wrapper">


                                <div class="swiper-slide">
                                    <div class="gallary-item">
                                        <img src="{{ $product->mainImage ? asset($product->mainImage->url) : asset($sampleProductImageUrl) }}" alt="shop">
                                    </div>
                                </div>


                                @foreach($product->galleryImages as $imageGallery)
                                    <div class="swiper-slide">
                                        <div class="gallary-item">
                                            <img src="{{ $product->mainImage ? asset($product->mainImage->url) : asset($sampleProductImageUrl) }}" alt="shop">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-nav-next"><i class="las la-arrow-right"></i></div>
                            <div class="swiper-nav-prev"><i class="las la-arrow-left"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-details">
                        <div class="product-info">
                            <div class="product-inner">
                                <span class="category">{{ $product->category->name }}</span>
                                <h3 class="title">{{ $product->name }}</h3>
                                <div class="rating-wrap">
                                    <ul class="rating">
                                        <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                        <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                        <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                        <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                        <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                    </ul>
                                    <span>(1 نظر مشتریان)</span>
                                </div>

                                @if($product->status ==  \App\Enums\ProductStatus::Exist)
                                    <h4 class="price">{{ $product->formatted_final_price }}  @lang('global.toman')<span>{{ $product->formatted_price }}  @lang('global.toman')</span></h4>
                                @else
                                    <h5 class="mb-4 text-danger">@lang('global.not_exist')</h5>
                                @endif

                                <div class="product-desc-wrap">
                                    <p class="desc">{!! $product->short_description !!}</p>
                                    <span class="view-text">
                                        <i class="fa-sharp fa-regular fa-eye"></i>
                                        {{ mt_rand(1,100) }} نفر در حال مشاهده این هستند
                                    </span>
                                </div>


                                @if($product->status ==  \App\Enums\ProductStatus::Exist)
                                    <div class="item-left-line">
                                        <span>فقط {{ $product->stock }} کالا در انبار باقی مانده است!</span>
                                        <div class="line" id="progress-line"></div>
                                    </div>
                                @endif


                                <ul class="details-list">
                                    <li><i class="fa-light fa-arrow-right-arrow-left"></i>گارانتی بازگشت</li>
                                    <li><i class="fa-light fa-truck"></i>ارسال رایگان محصول</li>
                                    <li><i class="fa-light fa-circle-check"></i>کلیه مالیات ها و عوارض گمرکی شامل می شود</li>
                                </ul>
                            </div>


                            @if($product->status ==  \App\Enums\ProductStatus::Exist)
                                <div class="product-btn">
                                    <form>
                                        <div class="quantity-selector">
                                            <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>
                                            <input type="number" id="qty-input" value="1" min="1" max="{{ $product->stock }}">
                                            <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
                                        </div>


                                    </form>
                                    <div class="cart-btn-wrap-2"><a wire:click="addProductToCart({{ $product->id }})" class="rr-primary-btn cart-btn cursor-pointer">افزودن به سبد خرید</a></div>
                                </div>
                                <a wire:click="addProductToCart({{ $product->id }},true)" class="shop-details-btn rr-primary-btn cursor-pointer">اکنون مورد را بخرید</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product-description pb-100">
        <div class="container rtl">
            <ul class="nav tab-navigation" id="product-tab-navigation" role="tablist">
                <li role="presentation">
                    <button class="active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                            role="tab" aria-controls="home" aria-selected="true">توضیحات
                    </button>
                </li>
                <li role="presentation">
                    <button id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab"
                            aria-controls="profile" aria-selected="false">اطلاعات تکمیلی
                    </button>
                </li>
                <li role="presentation">
                    <button id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab"
                            aria-controls="contact" aria-selected="false">نظرات ({{ $comments->count() }})
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="product-tab-content">
                <div class="tab-pane fade show active description" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="desc-wrap">
                        <div class="left-content">
                            <p class="mb-30">{!! $product->long_description !!} </p>
                        </div>
                        <div class="right-content">
                            <img src="{{ asset('images/site/shop-details-img.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    {!! $product->additional_information !!}
                </div>
                <div class="tab-pane fade review" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row product-review gy-lg-0 gy-4">

                        @if($comments->count() > 0)
                            <livewire:site.product-comments :product-id="$product->id"/>
                        @else
                            <p class="text-gray-500 italic text-center mt-6">نظر ثبت نشده، اولین نفری باشید که نظر می‌دهید!</p>
                        @endif

                        <div class="col-lg-7 col-md-12">
                            <div class="review-form-wrap">
                                <h4 class="title">نقد و بررسی این محصول</h4>
                                <span class="publish">آدرس ایمیل شما منتشر نخواهد شد. فیلدهای ضروری با * مشخص شده‌اند.</span>

                                @auth
                                    <div class="review-box">
                                        <span>امتیاز شما:</span>
                                        <ul class="review">
                                            <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                            <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                            <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                            <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                            <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                        </ul>
                                    </div>

                                    @include('custom-components.site.flash-message')

                                    @livewire('site.product-comment-form',['productId' => $product->id])

                                @else
                                    <div class="alert alert-warning mt-3">
                                        برای ثبت نظر لطفاً <a href="{{ route('site.login') }}" class="text-primary">وارد حساب کاربری خود شوید</a>.
                                    </div>
                                @endauth
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@section('scripts')
    <script>

        const maxStock = @json($product->stock);
        const input = document.getElementById("qty-input");
        const line = document.querySelector('.product-info .item-left-line .line');

        function updateLineProgress() {
            const value = parseInt(input.value) || 0;
            const percent = Math.min((value / maxStock) * 100, 100);
            line.style.setProperty('--line-width', percent + '%');

        }

        function changeQty(amount) {
            const min = parseInt(input.min);
            const max = parseInt(input.max);
            let current = parseInt(input.value) || min;
            let next = current + amount;
            if (next >= min && next <= max) {
                input.value = next;
                updateLineProgress();
            }
        }

        input.addEventListener("input", () => {
            const value = parseInt(input.value);
            if (value > maxStock) input.value = maxStock;
            if (value < 1 || isNaN(value)) input.value = 1;
            updateLineProgress();
        });

        updateLineProgress();

        window.addEventListener('product-added-to-cart', event => {
            Swal.fire({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 10000,
                background: '#F0FFF4',
                color: '#38A169',
                title: `${event.detail.name} به سبد خرید اضافه شد`,
                customClass: {title: 'swal2-title-rtl'},
                timerProgressBar: true,
            });
        });

        window.addEventListener('product-already-in-cart', event => {
            Swal.fire({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 10000,
                background: '#FEEBC8',
                color: '#D69E2E',
                title: `${event.detail.name} قبلاً به سبد خرید اضافه شده است`,
                customClass: {title: 'swal2-title-rtl'},
                timerProgressBar: true,
            });
        });

    </script>
@endsection
