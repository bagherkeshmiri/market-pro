<a
    @isset($classes)
        class="{{ $classes }}"
    @endisset

    data-toggle="modal"
    data-target="#{{ $modalId }}"
>
    {!! $icon !!}

    {{--    <i id="bx-show" class="bx bx-show" data-toggle="tooltip" data-placement="top" title="نمایش"></i>--}}
</a>
