<div>
    <section class="category-section pt-50 pb-50">
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
            <div class="category-carousel swiper">
                <div class="swiper-wrapper">

                    @foreach($items as $item)
                        <div class="swiper-slide">
                            <div class="category-item">
                                <div class="category-img">
                                    <img src="{{ $item->category->image ? asset($item->category->image->url) : asset($sampleImageUrl) }}" alt="category">
                                </div>
                                <h3 class="title">
                                    <a href="{{ route('site.products',['category' => $item->category->id]) }}">{{ $item->category->name }}</a>
                                </h3>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </section>
</div>
