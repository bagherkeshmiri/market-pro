<div class="custom-control custom-switch custom-switch-success mr-2" style="margin-top: 5px;">
    <input
        type="checkbox"
        class="custom-control-input"
        id="customSwitch-_{{ $model }}"
        wire:model.live="value"
    >
    <label class="custom-control-label" for="customSwitch-_{{ $model }}">
        <span class="switch-icon-left"><i class="bx bx-check"></i></span>
        <span class="switch-icon-right"><i class="bx bx-x"></i></span>
    </label>
    <span style="margin-right: 5px;">
        {{ $value ? 'فعال' : 'غیر فعال' }}
    </span>
</div>
