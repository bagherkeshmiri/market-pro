<div class="chip mr-1">
    <div class="chip-body">
        <div class="avatar {{ $avatarClass }}"

             @isset($wire)
                 wire:click="{{ $wire }}"
             @endisset

        >
            {!! $icon !!}
        </div>
        <span class="chip-text">{{ $content }}</span>
    </div>
</div>
