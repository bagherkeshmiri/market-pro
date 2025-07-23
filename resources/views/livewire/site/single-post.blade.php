<div>
    <section class="blog-details pt-50 pb-50">
        <div class="container rtl">
            <div class="row gy-5">
                <div class="col-lg-8 col-md-12">
                    <div class="blog-details-wrap">
                        <div class="blog-details-img">
                            <img src="{{ $post->image ? asset($post->image->url) : asset($this->getSampleImageUrl()) }}" alt="post-{{ $post->slug }}">
                        </div>
                        <div class="blog-details-content-wrap">
                            <ul class="post-meta">
                                <li><i class="fa-sharp fa-regular fa-clock"></i>{{ $post->jalali_created_at }}</li>
                                <li><i class="fa-light fa-user"></i>{{ $post->user->name ?? '' }}</li>
                                <li><i class="fa-light fa-list"></i>{{ $post->category->name ?? '' }}</li>
                            </ul>
                            <div class="blog-details-content">
                                <h2 class="details-title mb-25">{{ $post->title }}</h2>
                                {!! $post->body !!}
                            </div>
                            <div class="tags">
                                <div class="social-list-wrap">
                                    <h4 class="follow">مارا دنبال کنید:</h4>
                                    <ul class="social-list">
                                        <li>
                                            <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="blog-author-wrap">
                                <div class="blog-author-item">
                                    <div class="author-img">
                                        <img src="{{ asset('images/site/author-img.png') }}" alt="img">
                                    </div>
                                    <div class="content">
                                        <h3 class="name">درباره نویسنده</h3>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک استلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است</p>
                                        <ul class="social-list">
                                            <li>
                                                <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                            </li>
                                            <li>
                                                <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                                            </li>
                                            <li>
                                                <a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                                            </li>
                                            <li>
                                                <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="comments-area">
                                <div class="section-heading">
                                    <h2 class="section-title">نظرات ({{ $comments->count() }})</h2>
                                </div>

                                @if($comments->count() > 0)
                                    <livewire:site.post-comments :postId="$post->id "/>
                                @else
                                    <p class="text-gray-500 italic text-center mt-6">نظر ثبت نشده، اولین نفری باشید که نظر می‌دهید!</p>
                                @endif

                            </div>
                            <div class="form-wrap pt-70">
                                <div class="blog-contact-form">
                                    <h2 class="title">نظر بدهید</h2>

                                    @auth

                                        @include('custom-components.site.flash-message')

                                        @livewire('site.post-comment-form',['postId' => $post->id])

                                    @else
                                        <div class="alert alert-warning mt-3">
                                            برای ثبت نظر لطفاً <a href="{{ route('site.login') }}" class="text-primary">وارد حساب کاربری خود شوید</a>.
                                        </div>
                                    @endauth

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar-widget">
                        <div class="search-box">
                            <form action="https://html.rrdevs.net/roiser/contact.php" class="search-form">
                                <label for="search" hidden></label>
                                <input type="text" id="search" class="form-control" placeholder="جستجو">
                            </form>
                        </div>
                    </div>
                    <div class="sidebar-widget">
                        <h3 class="widget-title">دسته بندی</h3>
                        <ul class="sidebar-list">

                            @foreach($categories as $key => $value)
                                <li>
                                    <input type="checkbox" id="{{ $value }}" name="category-{{ $value }}" value="{{ $value }}">
                                    <label for="vehicle1">{{ $key }}</label><br>
                                </li>
                            @endforeach

                        </ul>
                    </div>

                    @if($lastPosts->count() > 0)
                        <div class="sidebar-widget">
                            <h3 class="widget-title">آخرین پست ها</h3>
                            @foreach($lastPosts as $lastPost)
                                <div class="sidebar-post">
                                    <img src="{{ $lastPost->image ? asset($lastPost->image->url) : asset($this->getSampleImageUrl()) }}" alt="post">
                                    <div class="post-content">
                                        <ul class="post-meta">
                                            <li><i class="fa-sharp fa-regular fa-clock"></i>{{ $lastPost->jalali_created_at }}</li>
                                        </ul>
                                        <h3 class="title"><a href="{{ route('site.single-post',['post' => $lastPost->slug]) }}">{{ $lastPost->title }}</a></h3>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
</div>
