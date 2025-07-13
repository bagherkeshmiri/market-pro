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

                    <livewire:site.product-slider-item
                        :product="$item->product"
                        :sample-product-image-url="$sampleProductImageUrl"
                        :key="$item->product->id"
                    />

                @endforeach
            </div>
        </div>
    </div>
</section>
