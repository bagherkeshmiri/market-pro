<div>
    <section class="blog-section pt-50 pb-50">
        <div class="container rtl">
            <div class="row gy-4">

                @forelse($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <livewire:site.post-card :post="$post" :wire:key="'post-card-'.$post->id"/>
                    </div>
                @empty
                    <div class="container my-5">
                        <div class="row justify-content-center">
                            <div class="col-md-8 text-center">
                                <div class="p-5 border rounded-3 shadow-sm bg-light">
                                    <h2 class="mb-3">هنوز هیچ پستی منتشر نشده است</h2>
                                    <p class="text-muted">
                                        به نظر می‌رسد هنوز محتوایی در وبلاگ قرار نگرفته.<br>
                                        به زودی مطالب جدید و جذابی اینجا منتشر خواهند شد.<br>
                                        لطفاً بعداً دوباره سر بزنید!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforelse

                @if ($posts->count())
                    {{ $posts->links('custom-components.site.pagination', ['items' => $posts]) }}
                @endif

            </div>
        </div>
    </section>
</div>
