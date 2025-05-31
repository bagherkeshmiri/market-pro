<div
    class="badge {{ $badgeClass }} mr-0 mb-1 @isset($classes) {{ $classes }} @endisset"

    @isset($id)
        id="{{ $id }}"
    @endisset
>
    {{ $content }}
</div>
