<div class="review-item">
    <div class="review-thumb">
        <img src="{{ asset('images/frest/avatar-s-16.png') }}" alt="img">
    </div>
    <div class="content">
        <div class="content-top">
            <h4 class="name">
                {{ $comment->user->name }}
                <span>{{ $comment->jalali_created_at }}</span>
            </h4>
            <ul class="review">
                @for ($i = 0; $i < 5; $i++)
                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                @endfor
            </ul>
        </div>

        <p>
            {{ $expanded ? $comment->body : \Illuminate\Support\Str::limit($comment->body) }}
            @if (strlen($comment->body) > 100)
                <a wire:click="toggle" style="color: blue; cursor: pointer; margin-right:15px;">
                    {{ $expanded ? 'کمتر' : 'بیشتر' }}
                </a>
            @endif
        </p>
    </div>
</div>
