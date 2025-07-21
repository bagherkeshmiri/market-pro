<div>
    <section class="blog-section pt-50 pb-50">
        <div class="container rtl">
            <div class="row gy-4">

                @forelse($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="post-card">
                            <div class="post-thumb">
                                <img src="{{ asset('images/site/post-7.jpg') }}" alt="post">
                            </div>
                            <div class="post-content-wrap">
                                <div class="post-content">
                                    <ul class="post-meta">
                                        <li><i class="fa-sharp fa-solid fa-calendar-days"></i>{{ $post->comments->count() }} نظر</li>
                                        <li><i class="fa-regular fa-tag"></i>{{ $post->category->name ?? '' }}</li>
                                    </ul>
                                    <h3 class="title"><a href="{{ route('site.single-post',['post' => $post->slug]) }}">{{ $post->title }}</a></h3>
                                    <p class="mt-4" style="margin-bottom: 0 !important;">{{ $post->excerpt }}</p>
                                </div>
                                <div class="post-bottom">
                                    <a href="{{ route('site.single-post',['post' => $post->slug]) }}" class="read-more">بیشتر بدانید<i class="fa-regular fa-arrow-left"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse

                @if($posts->count() > $this->perPage)
                    {{ $posts->links('custom-components.site.pagination', ['items' => $posts]) }}
                @endif
            </div>
        </div>
    </section>
</div>
