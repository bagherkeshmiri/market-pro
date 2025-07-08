<div class="position-relative has-icon-left">
    <input
        @isset($type)
            type="{{ $type }}"
        @endisset

        @isset($inputName)
            name="{{ $inputName }}"
        @endisset

        @isset($wire)
            wire:model.defer="{{$wire}}"
        @endisset

        @isset($id)
            id="{{ $id }}"
        @endisset


        class="form-control  text-white @isset($classes)  {{$classes}} @endisset"

        @isset($placeholder)
            placeholder="{{ $placeholder }}"
        @endisset

        @isset($attributes)
            {{$attributes}}
        @endisset

        @isset($options)
            {{ $options }}
        @endisset

        @isset($tabindex)
            tabindex="{{ $tabindex }}"
        @endisset

        @isset($isPriceInput)
            oninput="formatPrice(this)"
        @endisset


    >
    <div class="form-control-position">
        {!! $icon !!}
    </div>
</div>





