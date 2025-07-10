<ul class="pagination-wrap mt-50">
    @if ($comments->onFirstPage())
        <li><a class="disabled"><i class="fa-solid fa-chevron-right"></i></a></li>
    @else
        <li><a href="#" wire:click.prevent="previousPage"><i class="fa-solid fa-chevron-right"></i></a></li>
    @endif

    @foreach ($comments->getUrlRange(1, $comments->lastPage()) as $page => $url)
        @if ($page == $comments->currentPage())
            <li><a href="#" class="active">{{ $page }}</a></li>
        @else
            <li><a href="#" wire:click.prevent="gotoPage({{ $page }})">{{ $page }}</a></li>
        @endif
    @endforeach

    @if ($comments->hasMorePages())
        <li><a href="#" wire:click.prevent="nextPage"><i class="fa-solid fa-chevron-left"></i></a></li>
    @else
        <li><a class="disabled"><i class="fa-solid fa-chevron-left"></i></a></li>
    @endif
</ul>
