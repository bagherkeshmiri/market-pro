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

    class="form-control {{ $classes }}"

>

{{--<input type="email" id="email" wire:model.defer="email" class="form-control">--}}



