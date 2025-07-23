<div>
    @foreach($comments as $comment)
        <livewire:site.single-post-comment-item :comment="$comment" :key="$comment->id"/>
    @endforeach

    {{ $comments->links('custom-components.site.livewire-pagination',['items' => $comments]) }}

</div>
