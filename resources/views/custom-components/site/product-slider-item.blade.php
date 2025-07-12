<div class="swiper-slide">
    <div class="shop-item">
        <div class="shop-thumb">
            <div class="overlay"></div>
            <img src="{{ $product->mainImage ? asset($product->mainImage->url) : asset($sampleProductImageUrl) }}" alt="shop">
            @if($product->discount > 0)
                <span class="sale">{{ $product->discount_percent }} %</span>
            @endif
            <ul class="shop-list">
                @if($product->status == \App\Enums\ProductStatus::Exist)
                    <li>
                        <a onclick="Cart.add({ id: {{ $product->id }}, quantity: 1, name: '{{ $product->name }}', price: {{ $product->final_price }} , image: '{{ $product->mainImage ? $product->mainImage->url : $sampleProductImageUrl }}' })">
                            <i class="fa-regular fa-cart-shopping"></i>
                        </a>
                    </li>
                @endif
                <li><a href="#"><i class="fa-light fa-heart"></i></a></li>
                <li><a href="#"><i class="fa-light fa-eye"></i></a></li>
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
