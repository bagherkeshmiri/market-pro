<select class="form-control font-13"

        @isset($inputName)
            name="{{ $inputName }}"
        @endisset

        @isset($wire)
            wire:model.defer="{{$wire}}"
        @endisset

        @isset($id)
            id="{{ $id }}"
        @endisset

        @isset($attributes)
            {{ $attributes }}
        @endisset

        required
>

    @isset($defaultOption)
        <option  @isset($defaultValue) @endisset> -- انتخاب کنید -- </option>
    @endisset

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
