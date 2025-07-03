<select class="form-control font-13 text-white"

        @isset($inputName)
            name="{{ $inputName }}"
        @endisset

        @isset($wire)

            @isset($isLazy)
                wire:model.lazy="{{ $wire }}"
            @endisset

            @isset($isDefer)
                wire:model.defer="{{ $wire }}"
            @endisset

            @isset($isWire)
                wire:model="{{ $wire }}"
            @endisset

        @endisset




        @isset($id)
            id="{{ $id }}"
        @endisset

        @isset($attributes)
            {{ $attributes }}
        @endisset


            style="	background-image: url({{ asset('images/frest/arrow-down.png') }});"


        required
>

    @isset($data)
        @foreach($data as $key => $value)
            <option
                value="{{ $value }}"
            >
                {{ $key }}
            </option>
        @endforeach
    @endisset

</select>
