<section class="ftco-section" style="padding-bottom: 3rem !important;">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h2 class="mb-4">{{ $title }}</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach($products as $product)
                @include('custom-components.site.product-card',['product' => $product, 'sampleProductImageUrl' => $sampleProductImageUrl])
            @endforeach
        </div>
    </div>
</section>
