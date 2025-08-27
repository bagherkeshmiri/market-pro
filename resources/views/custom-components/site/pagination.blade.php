<ul class="pagination-wrap justify-content-center mt-50" style="cursor: pointer">
    @if ($items->onFirstPage())
        <li><a class="disabled" role="button"><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
    @else
        <li><a wire:click="previousPage"><i class="fa-solid fa-chevron-right"></i></a></li>
    @endif

    @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
        @if ($page == $items->currentPage())
            <li><a href="#" class="active">{{ $page }}</a></li>
        @else
            <li><a wire:click="gotoPage({{ $page }})" role="button">{{ $page }}</a></li>
        @endif
    @endforeach

    @if ($items->hasMorePages())
        <li><a wire:click="nextPage" role="button"><i class="fa-solid fa-chevron-left"></i></a></li>
    @else
        <li><a class="disabled"><i class="fa-solid fa-chevron-left"></i></a></li>
    @endif
</ul>
