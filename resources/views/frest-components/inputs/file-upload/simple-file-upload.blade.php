<fieldset class="form-group mb-0">
    <div class="custom-file">
        <input type="file" class="custom-file-input"
               @isset($wire)
                   wire:model.defer="{{$wire}}"
               @endisset

               @isset($id)
                   id="{{ $id }}"
               @endisset

               @isset($isMultiple)
                   multiple
            @endisset

        >
        <label class="custom-file-label" for="inputGroupFile01">انتخاب فایل</label>
    </div>
</fieldset>
