<div class="post-card">
    <div class="post-thumb">
        <img src="{{ asset($image) }}" alt="post">
    </div>
    <div class="post-content-wrap">
        <div class="post-content">
            <ul class="post-meta">
                <li><i class="fa-sharp fa-solid fa-calendar-days"></i>{{ $commentsCount }} نظر</li>
                <li><i class="fa-regular fa-tag"></i>{{ $categoryName }}</li>
            </ul>
            <h3 class="title"><a href="{{ route('site.single-post',['post' => $slug]) }}">{{ $title }}</a></h3>
            <p class="mt-4" style="margin-bottom: 0 !important;">{{ $excerpt }}</p>
        </div>
        <div class="post-bottom">
            <a href="{{ route('site.single-post',['post' => $slug]) }}" class="read-more"
               aria-label="بیشتر بدانید درباره {{ $title }}">
                بیشتر بدانید
                <span class="sr-only"> درباره {{ $title }}</span>
                <i class="fa-regular fa-arrow-left" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</div>
