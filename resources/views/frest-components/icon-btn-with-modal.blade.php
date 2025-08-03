<a
    @isset($classes)
        class="{{ $classes }}"
    @endisset

    data-toggle="modal"
    data-target="#{{ $modalId }}"
>
    {!! $icon !!}

</a>
