<div>
    <section class="blog-details pt-50 pb-50">
        <div class="container rtl">
            <div class="row gy-5">
                <div class="col-lg-8 col-md-12">
                    <div class="blog-details-wrap">
                        <div class="blog-details-img">
                            <img src="{{ asset('images/site/blog-details-img.jpg') }}" alt="blog">
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
                                {{--                                <div class="tag-left">--}}
                                {{--                                    <ul class="tag-list">--}}
                                {{--                                        <li><a href="#">فشن</a></li>--}}
                                {{--                                        <li><a href="#">پوشاک</a></li>--}}
                                {{--                                        <li><a href="#">مبلمان</a></li>--}}
                                {{--                                    </ul>--}}
                                {{--                                </div>--}}
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
                                    <h2 class="section-title">نظرات (3)</h2>
                                </div>
                                <div class="comment-item">
                                    <div class="comment-thumb">
                                        <img src="{{ asset('images/site/comment-thumb-1.png') }}" alt="author">
                                    </div>
                                    <div class="comment-info">
                                        <div class="comments-meta">
                                            <span><i class="fa-light fa-circle-user"></i>10 خرداد 1403</span>
                                        </div>
                                        <h3 class="author">آصف هاشمی </h3>
                                        <p>
                                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک استلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است
                                        </p>
                                        <button class="reply">پاسخ دهید</button>
                                    </div>
                                </div>
                                <div class="comment-item item-2">
                                    <div class="comment-thumb">
                                        <img src="{{ asset('images/site/comment-thumb-2.png') }}" alt="author">
                                    </div>
                                    <div class="comment-info">
                                        <div class="comments-meta">
                                            <span><i class="fa-light fa-circle-user"></i>10 خرداد 1403</span>
                                        </div>
                                        <h3 class="author">آناهیتا دلپذیر </h3>
                                        <p>
                                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک استلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است
                                        </p>
                                        <button class="reply">پاسخ دهید</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-wrap pt-70">
                                <div class="blog-contact-form">
                                    <h2 class="title">نظرات اضافه کنید</h2>
                                    <p>آدرس ایمیل شما منتشر نخواهد شد. فیلدهای الزامی مشخص شده اند *</p>
                                    <div class="request-form">
                                        <form action="#" method="post" id="ajax_contact" class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <div class="form-item">
                                                        <label for="fullname" hidden></label>
                                                        <input type="text" id="fullname" name="fullname" class="form-control" placeholder="نام شما">
                                                        <div class="icon"><i class="fa-regular fa-user"></i></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-item">
                                                        <label for="email" hidden></label>
                                                        <input type="email" id="email" name="email" class="form-control" placeholder="ایمیل شما">
                                                        <div class="icon"><i class="fa-sharp fa-regular fa-envelope"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <div class="form-item message-item">
                                                        <label for="message" hidden></label>
                                                        <textarea id="message" name="message" cols="30" rows="5" class="form-control address" placeholder="پیام شما"></textarea>
                                                        <div class="icon"><i class="fa-light fa-messages"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="submit-btn">
                                                <button id="submit" class="rr-primary-btn" type="submit">ارسال پیام</button>
                                            </div>
                                        </form>
                                    </div>
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
                                    <img src="{{ asset('images/site/sidebar-thumb-1.png') }}" alt="post">
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
