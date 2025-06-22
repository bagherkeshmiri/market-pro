@section('styles')
@endsection

<div>
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="#" class="image-popup">
                        <img src="{{ $product->mainImage ? asset($product->mainImage->image_url) : asset($sampleProductImageUrl) }}" class="img-fluid" alt="Colorlib Template">
                    </a>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3>{{ $product->name }}</h3>
                    <div class="rating d-flex">
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2">5.0</a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                        </p>
                    </div>
                    <p class="price"><span>{{ $product->formatted_final_price }}  تومان </span></p>
                    <p> {!! $product->description ? $sampleProductDescription : $product->description !!} </p>
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
        $(document).ready(function(){

            var quantitiy=0;
            $('.quantity-right-plus').click(function(e){

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                $('#quantity').val(quantity + 1);


                // Increment

            });

            $('.quantity-left-minus').click(function(e){
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                // Increment
                if(quantity>0){
                    $('#quantity').val(quantity - 1);
                }
            });

        });
    </script>
@endsection
