<section class="blog-section pb-50">
    <div class="container rtl">
        <div class="section-heading text-center">
            <a href="{{ route('site.blog') }}">
                <h2 class="section-title mb-0">آخرین‌ اخبار ما</h2>
            </a>
        </div>
        <div class="row gy-lg-0 gy-4 justify-content-center">

            @foreach($posts as $post)
                <div class="col-lg-4 col-md-6">
                    <livewire:site.post-card :post="$post"/>
                </div>
            @endforeach()

        </div>
    </div>
</section>
