@if ($paginator->hasPages())
    <div class="block-27">
        <ul>
            {{-- دکمه قبلی --}}
            @if ($paginator->onFirstPage())
                <li><span>&lt;</span></li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" wire:click.prevent="previousPage">&lt;</a>
                </li>
            @endif

            {{-- شماره صفحات --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li>
                                <a href="{{ $url }}" wire:click.prevent="gotoPage({{ $page }})">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- دکمه بعدی --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" wire:click.prevent="nextPage">&gt;</a>
                </li>
            @else
                <li><span>&gt;</span></li>
            @endif
        </ul>
    </div>
@endif
