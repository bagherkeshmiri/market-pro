@section('styles')
@endsection

<div>
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <img src="{{ $product->mainImage ? asset($product->mainImage->image_url) : asset($sampleProductImageUrl) }}" class="img-fluid" style="border-radius: 8px; border: 1px solid #82ae46" alt="{{ $product->name }}">

                    <div class="image-gallery-carousel owl-carousel pt-3">

                        @forelse($product->galleryImages as $imageGallery)
                            <div class="item">
                                <img src="{{ $imageGallery->image_url }}" style="width: 150px !important; border-radius: 8px; border: 1px solid #82ae46" alt=""/>
                            </div>

                        @empty
                            <div class="item">
                                <img src="{{ $product->mainImage ? asset($product->mainImage->image_url) : asset($sampleProductImageUrl) }}" style="width: 150px !important; border-radius: 8px; border: 1px solid #82ae46" alt=""/>
                            </div>
                        @endforelse

                    </div>

                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3>{{ $product->name }}</h3>

                    <div class="rating d-flex">
                        <span>امتیاز محصول : </span>
                        <p class="text-left mr-4">
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star"></span></a>
                            <a href="#"><span class="ion-ios-star"></span></a>
                            <a href="#"><span class="ion-ios-star"></span></a>
                            <a href="#"><span class="ion-ios-star"></span></a>
                        </p>
                    </div>


                    @if($product->status ==  \App\Enums\ProductStatus::Exist)
                        <div>
                            @if($product->discount > 0)
                                <div class="d-flex flex-row align-content-center">
                                    <h5 class=" ml-4 price-dc">     {{ number_format($product->price) }} @lang('global.toman')  </h5>
                                    <span class="text-white text-center p-2" style="background:#82ae46; border-radius: 20px; ">% {{ $product->discount_percent }} </span>
                                </div>
                            @endif
                            <h3 class="price mb-2">{{ $product->formatted_final_price }}  @lang('global.toman') </h3>
                        </div>
                    @else
                        <h5 class="mb-4 text-danger">@lang('global.not_exist')</h5>
                    @endif


                    <p> {!! $product->description ?? $sampleProductDescription !!} </p>

                    @if($product->status ==  \App\Enums\ProductStatus::Exist)
                        <div class="row mt-4">
                            <div class="w-100"></div>
                            <div class="input-group col-md-6 d-flex mb-3">
	             	<span class="input-group-btn mr-2">
	                	<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
	                   <i class="ion-ios-remove"></i>

	                	</button>
	            		</span>
                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="0" min="1" max="{{ $product->stock }}">
                                <span class="input-group-btn ml-2">
	                	<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
	                     <i class="bx bx-plus"></i>
	                 </button>
	             	</span>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <p style="color: #000;">موجودی {{ $product->stock }} عدد</p>
                            </div>
                        </div>
                        <p><a href="#" class="btn btn-black py-3 px-5">اضافه به سبد خرید </a></p>
                    @endif

                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section mb-5">
        <div class="container">
            <div class="row justify-content-center pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <h5 class="mb-4"> محصولات مشابه</h5>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="product-carousel owl-carousel">

                        @foreach($products as $product)
                            <div class="item">
                                @include('custom-components.site.slider-product-card',['product' => $product, 'sampleProductImageUrl' => $sampleProductImageUrl])
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@section('scripts')
    <script>
        $(document).ready(function () {

            var quantitiy = 0;
            $('.quantity-right-plus').click(function (e) {

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                $('#quantity').val(quantity + 1);


                // Increment

            });

            $('.quantity-left-minus').click(function (e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                // Increment
                if (quantity > 0) {
                    $('#quantity').val(quantity - 1);
                }
            });

        });
    </script>
@endsection
