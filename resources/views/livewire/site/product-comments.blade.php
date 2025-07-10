<div class="col-lg-5 col-md-12">
    <div class="reviewr-wrap">
        <div class="review-list">

            @foreach($comments as $comment)
                <div class="review-item">
                    <div class="review-thumb">
                        <img src="{{ asset('images/frest/avatar-s-16.png') }}" alt="img">
                    </div>
                    <div class="content">
                        <div class="content-top">
                            <h4 class="name">{{ $comment->user->name }}<span>{{ $comment->jalali_created_at }} </span></h4>
                            <ul class="review">
                                <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                <li><i class="fa-sharp fa-solid fa-star"></i></li>
                            </ul>
                        </div>
                        <p>{{ $comment->body }}</p>
                    </div>
                </div>
            @endforeach

                {{ $comments->links('custom-components.site.pagination',['comments' => $comments]) }}

        </div>
    </div>
</div>
