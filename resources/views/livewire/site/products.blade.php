@section('styles')
    <style>
        .swal2-title-rtl {
            direction: rtl !important;
            text-align: right !important;
        }
    </style>
@endsection

<section class="shop-grid-2 pt-50 pb-50">
    <div class="container rtl">
        <div class="row gy-4">

            @forelse($products as $product)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="shop-item">
                        <div class="shop-thumb">
                            <div class="overlay"></div>
                            <img src="{{ $product->mainImage ? asset($product->mainImage->url) : asset($this->getSampleImageUrl()) }}" alt="shop">
                            @if($product->discount > 0)
                                <span class="sale">{{ $product->discount_percent }} %</span>
                            @endif
                            <ul class="shop-list">
                                @if($product->status == \App\Enums\ProductStatus::Exist)
                                    <li>
                                        <a wire:click="addProductToCart({{ $product->id }})">
                                            <i class="fa-regular fa-cart-shopping"></i>
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a role="button"
                                        wire:click="addProductToWishlist({{ $product->id }})"
                                       aria-label="افزودن محصول به علاقه‌مندی‌ها">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </li>
                                <li><a href="{{ route('site.single-product',['product' => $product->id]) }}"><i class="fa-light fa-eye"></i></a></li>
                            </ul>
                        </div>
                        <div class="shop-content">
                            <span class="category">{{ $product->category->name }}</span>
                            <h3 class="title"><a href="{{ route('site.single-product',['product' => $product->id]) }}">{{ $product->name }}</a></h3>
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
                            @if($product->status ==  \App\Enums\ProductStatus::Exist)
                                <span class="price">
                                        @if($product->discount > 0)
                                        <span class="offer">
                                        {{ $product->formatted_price }}  @lang('global.toman')
                                        </span>
                                    @endif
                                    {{ $product->formatted_final_price }}  @lang('global.toman')
                                    </span>
                            @else
                                <h5 class="mt-3 text-danger">@lang('global.not_exist')</h5>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div style="text-align: center; margin-top: 20px; width: 100%;">
                    <img src="{{ asset('images/site/error-img.png') }}"
                         style="width: 50%; height: auto;"
                         alt="محصولی یافت نشد"
                    >
                    <p style="margin-top: 50px; font-size: 2rem; color: #555;">محصولی یافت نشد</p>
                </div>
            @endforelse
        </div>

        @if($products->count() > $this->perPage)
            {{ $products->links('custom-components.site.pagination', ['items' => $products]) }}
        @endif
    </div>
</section>

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

