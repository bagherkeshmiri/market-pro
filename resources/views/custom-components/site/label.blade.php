<label
    class="form-header text-dark mb-0 {{ $classes }}"

    @isset($for)
        for="{{ $for }}"
    @endisset
>

    {{ $content }}
</label>
