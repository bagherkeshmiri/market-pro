<div class="col-md-6 col-lg-3 ftco-animate">
    <div class="product" style=" border: 1px solid #82ae46">
        <a href="{{ route('site.single-product',['product' => $product->id]) }}" class="img-prod">
            <img class="img-fluid" src="{{ $product->mainImage ? asset($product->mainImage->image_url) : asset($sampleProductImageUrl) }}" alt="{{ $product->name }}"/>
            @if($product->discount > 0 && $product->status ==  \App\Enums\ProductStatus::Exist)
                <span class="status">% {{ $product->discount_percent }} </span>
            @endif

            <div class="overlay"></div>
        </a>
        <div class="text py-3 pb-4 px-3 text-center">
            <h3><a href="#">{{ $product->name }}</a></h3>
            <div class="d-flex">

                @if($product->status ==  \App\Enums\ProductStatus::Exist)
                    <div class="pricing">
                        <p class="price">
                            @if($product->discount > 0)
                                <span class="me-4 price-dc">     {{ number_format($product->price) }} @lang('global.toman')  </span>
                            @endif
                            <span class="price-sale">   {{ number_format($product->final_price) }} @lang('global.toman')  </span>
                        </p>
                    </div>

                @else
                    <div class="pricing">
                        <span class="text-danger text-center">@lang('global.not_exist')</span>
                    </div>
                @endif


            </div>
            <div class="bottom-area d-flex px-3">
                <div class="m-auto d-flex">
                    <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
                        <span><i class="ion-ios-cart"></i></span>
                    </a>
                    <a href="#" class="heart d-flex justify-content-center align-items-center ">
                        <span><i class="ion-ios-heart"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
