<div class="comment-item">

    <div class="comment-thumb">
        <img src="{{ asset('images/site/comment-thumb-1.png') }}" alt="author">
    </div>
    <div class="comment-info">
        <div class="comments-meta">
           <span style="display: inline-flex; align-items: center; gap: 12px;">
              <i class="fa-light fa-user ml-1"></i> {{ $comment->user->name ?? '' }}
              <i class="fa-sharp fa-regular fa-clock"></i> {{ $comment->jalali_created_at }}
           </span>
        </div>
        <h3 class="author"> {{ $comment->user->name }}</h3>
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




