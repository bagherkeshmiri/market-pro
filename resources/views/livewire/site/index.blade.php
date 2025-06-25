@section('styles')
@endsection


<div>
    @include('custom-components.site.image-slider')
    @include('custom-components.site.slide-caption')
    @include('custom-components.site.spacial-products',['title' => 'سرزمین پیکسلی','products' => $products , 'sampleProductImageUrl' => $sampleProductImageUrl])


    <section class="ftco-section mb-5">
        <div class="container">
            <div class="row justify-content-center pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <h5 class="mb-4"> محصولات پر فروش</h5>
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
@endsection
