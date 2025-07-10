<a
    @isset($classes)
        class="{{ $classes }}"
    @endisset

    @isset($id)
        id="{{ $id }}"
    @endisset

    @isset($href)
        href="{{ $href }}"
    @endisset

    @isset($tooltipTitle)
        data-toggle="tooltip"
        data-placement="top"
        data-original-title="{{ $tooltipTitle }}"
    @endisset

    @isset($attributes)
        {{ $attributes }}
    @endisset
   >
    {!! $icon !!}

</a>
