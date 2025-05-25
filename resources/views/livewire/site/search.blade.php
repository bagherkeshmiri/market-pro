<div class="form-group has-icon" style="position: relative;">
    <i class="bx bx-search fa fa-search"></i>
    <input type="text" class="form-control search font-size-14 text-grey-7" wire:model.debounce.1000ms="search" placeholder="جستجو...">
    <i wire:loading class="bx bx-loader loader optimized-loader"></i>
    @if($showSearchResultDiv && count($items) != 0)
        <ul class="none-style-ul pt-3 pb-4  p-0 text-left font-size-14 shadow rounded-right rounded-left text-grey-5 search-menu">
            @foreach($items as $item)
                <li class="pl-4 py-1 cursor-pointer">
                    <a href="{{ route('site.redirect',['link' => $item->link]) }}">
                        {{$item->title}}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
