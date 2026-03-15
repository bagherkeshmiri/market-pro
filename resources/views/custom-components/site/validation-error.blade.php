<div class="text-end" dir="{{ app()->isLocale('fa') ? 'rtl' : 'ltr' }}">
    @error($name)
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
