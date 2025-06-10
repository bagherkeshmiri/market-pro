<div
    class="badge {{ $badgeClass }}  @isset($classes) {{ $classes }} @endisset"

    @isset($id)
        id="{{ $id }}"
    @endisset
>
    {{ $content }}
</div>
