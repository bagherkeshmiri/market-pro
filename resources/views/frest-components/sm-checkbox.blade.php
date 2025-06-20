<fieldset>
    <div class="checkbox checkbox-sm {{ $checkboxClass }} checkbox-glow @isset($classes)  {{ $classes }}  @endisset">
        <input type="checkbox"

               @isset($wire)
                   wire:model.defer="{{$wire}}"
               @endisset

               @isset($wireSimple)
                   wire:model="{{$wireSimple}}"
               @endisset

               @isset($value)
                   value="{{ $value }}"
               @endisset

               id="{{ $id }}"

               @isset($input_classes)
                   class="{{$input_classes}}"
            @endisset

        @isset($attributes)
            {{ $attributes }}
            @endisset

        >
        <label class="text-white"

               for="{{ $for }}"
        >
            {{ $label_content }}
        </label>
    </div>
</fieldset>
