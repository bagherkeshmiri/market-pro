@section('styles')
    <style>
        .swal2-title-rtl {
            direction: rtl !important;
            text-align: right !important;
        }
    </style>
@endsection

<div wire:ignore>
    <section class="fashion-section pb-50">
        <div class="container rtl">
            <div class="category-top heading-space space-border">
                <div class="section-heading mb-0">
                    <h2 class="section-title">{{ $title }}</h2>
                </div>
                <div class="swiper-arrow">
                    <div class="swiper-nav swiper-next"><i class="fa-regular fa-arrow-right"></i></div>
                    <div class="swiper-nav swiper-prev"><i class="fa-regular fa-arrow-left"></i></div>
                </div>
            </div>
            <div class="shop-carousel swiper">
                <div class="swiper-wrapper">
                    @foreach($items as $item)

                        <div class="swiper-slide">
                            <div class="shop-item">
                                <div class="shop-thumb">
                                    <div class="overlay"></div>
                                    <img src="{{ $item->product->mainImage ? asset($item->product->mainImage->url) : asset($sampleImageUrl) }}" alt="shop">
                                    @if($item->product->discount > 0)
                                        <span class="sale">{{ $item->product->discount_percent }} %</span>
                                    @endif
                                    <ul class="shop-list">
                                        @if($item->product->status == \App\Enums\ProductStatus::Exist)
                                            <li>
                                                <a wire:click="addProductToCart({{ $item->product->id }})">
                                                    <i class="fa-regular fa-cart-shopping"></i>
                                                </a>
                                            </li>
                                        @endif
                                        <li>
                                            <a wire:click="addProductToWishlist({{ $item->product->id }})">
                                                <i class="fa-regular fa-heart"></i>
                                            </a>
                                        </li>
                                        <li><a href="#"><i class="fa-light fa-eye"></i></a></li>
                                    </ul>
                                </div>
                                <div class="shop-content">
                                    <span class="category">{{ $item->product->category->name }}</span>
                                    <h3 class="title"><a href="{{ route('site.single-product',['product' => $item->product->id]) }}">{{ $item->product->name }}</a></h3>
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

                                    @if($item->product->status ==  \App\Enums\ProductStatus::Exist)
                                        <span class="price">
                                        @if($item->product->discount > 0)
                                                <span class="offer">
                                        {{ $item->product->formatted_price }}  @lang('global.toman')
                                        </span>
                                            @endif
                                            {{ $item->product->formatted_final_price }}  @lang('global.toman')
                                    </span>
                                    @else
                                        <h5 class="mt-3 text-danger">@lang('global.not_exist')</h5>
                                    @endif

                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>

@section('scripts')
    <script>
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

        window.addEventListener('product-added-to-wishlist', event => {
            Swal.fire({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 10000,
                background: '#F0FFF4',
                color: '#38A169',
                title: `${event.detail.name} به لیست علاقه مندی اضافه شد`,
                customClass: {title: 'swal2-title-rtl'},
                timerProgressBar: true,
            });
        });

        window.addEventListener('product-already-in-wishlist', event => {
            Swal.fire({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 10000,
                background: '#FEEBC8',
                color: '#D69E2E',
                title: `${event.detail.name} قبلاً به لیست علاقه مندی اضافه شده است`,
                customClass: {title: 'swal2-title-rtl'},
                timerProgressBar: true,
            });
        });
    </script>
@endsection
