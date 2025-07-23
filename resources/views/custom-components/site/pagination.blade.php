<ul class="pagination-wrap justify-content-center mt-50">
    @if ($items->onFirstPage())
        <li><a class="disabled"><i class="fa-solid fa-chevron-right"></i></a></li>
    @else
        <li><a href="{{ $paginator->previousPageUrl() }}"><i class="fa-solid fa-chevron-right"></i></a></li>
    @endif

    @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
        @if ($page == $items->currentPage())
            <li><a href="#" class="active">{{ $page }}</a></li>
        @else
            <li><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
    @endforeach

    @if ($items->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}"><i class="fa-solid fa-chevron-left"></i></a></li>
    @else
        <li><a class="disabled"><i class="fa-solid fa-chevron-left"></i></a></li>
    @endif
</ul>
