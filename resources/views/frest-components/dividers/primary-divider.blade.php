<div class="col-md-12 col-12">
    <div class="divider divider-primary">
        <div class="divider-text">
            @if(isset($title))
                @if(!empty($isIcon))
                    {!! $title !!}
                @elseif(!empty($isString))
                    {{ $title }}
                @endif
            @endif
        </div>
    </div>
</div>
