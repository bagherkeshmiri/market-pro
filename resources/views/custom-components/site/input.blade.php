<input
    @isset($type)
        type="{{ $type }}"
    @endisset

    @isset($wire)
        wire:model.defer="{{ $wire }}"
    @endisset

    @isset($id)
        id="{{ $id }}"
    @endisset

    @isset($attributes)
        {{$attributes}}
    @endisset

    class="form-control {{ $classes }}"
>
