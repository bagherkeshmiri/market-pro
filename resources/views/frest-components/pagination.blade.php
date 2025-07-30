@if ($paginator->hasPages())

    <div class="d-flex justify-content-center mt-2">
        <nav>
            <ul class="pagination" style="cursor:pointer;">
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link" aria-hidden="true">&lsaquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" wire:click="previousPage" rel="prev">&lsaquo;</a>
                    </li>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span
                                class="page-link">{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span
                                        class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link"
                                                         wire:click="gotoPage({{ $page }})">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" wire:click="nextPage" rel="next">&rsaquo;</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link" aria-hidden="true">&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

@endif
