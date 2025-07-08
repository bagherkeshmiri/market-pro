<div class="chip mr-1">
    <div class="chip-body">
        <div class="avatar {{ $avatarClass }}"

             style="cursor: pointer"

             @isset($wire)
                 wire:click="{{ $wire }}"
             @endisset

        >
            {!! $icon !!}
        </div>
        <span class="chip-text">{{ $content }}</span>
    </div>
</div>
