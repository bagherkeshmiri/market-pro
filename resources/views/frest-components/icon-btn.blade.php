<a
    @isset($classes)
        class="{{ $classes }}"
    @endisset

    @isset($id)
        id="{{ $id }}"
    @endisset

    @isset($href)
        href="{{ $href }}"
        target="_blank"
    @endisset

    @isset($tooltipTitle)
        data-toggle="tooltip"
    data-placement="top"
    data-original-title="{{ $tooltipTitle }}"
    @endisset


    @isset($wire)
        @isset($isLazy)
            wire:model.lazy="{{ $wire }}"
        @endisset

        @isset($isDefer)
            wire:model.defer="{{ $wire }}"
        @endisset

        @isset($isClick)
            wire:click="{{ $wire }}"
        @endisset

    @endisset


@isset($attributes)
    {{ $attributes }}
    @endisset
>
    {!! $icon !!}

</a>
