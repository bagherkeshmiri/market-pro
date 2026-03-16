<textarea
    cols="30"

    rows="5"

    class="form-control {{ $classes }}

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

>

</textarea>


{{--<textarea id="message" name="message" cols="30" rows="5" class="form-control address">--}}
