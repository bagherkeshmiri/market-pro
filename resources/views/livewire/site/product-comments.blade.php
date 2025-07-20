<div class="col-lg-5 col-md-12">
    <div class="reviewr-wrap">
        <div class="review-list">

            @foreach($comments as $comment)
                <livewire:site.single-product-comment-item :comment="$comment" :key="$comment->id"/>
            @endforeach

            {{ $comments->links('custom-components.site.pagination',['items' => $comments]) }}

        </div>
    </div>
</div>
