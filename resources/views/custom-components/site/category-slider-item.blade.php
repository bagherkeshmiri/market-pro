<div class="swiper-slide">
    <div class="category-item">
        <div class="category-img">
            <img src="{{ $category->image ? asset($category->image->url) : asset($sampleProductImageUrl) }}" alt="category">
        </div>
        <h3 class="title">
            <a href="#">{{ $title }}</a>
        </h3>
    </div>
</div>
