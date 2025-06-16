<div>
    @include('custom-components.site.image-slider')
    @include('custom-components.site.slide-caption')
    @include('custom-components.site.spacial-products',['products' => $products , 'sampleProductImageUrl' => $sampleProductImageUrl])
</div>
