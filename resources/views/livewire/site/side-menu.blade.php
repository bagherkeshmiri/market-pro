@livewire('site.search')

<ul class="none-style-ul pt-4 p-0 text-left font-size-14" id="accordion">

    @foreach($items as $item)
        <li class="pb-4 " id="heading{{$item->id}}">
            <div class="d-flex justify-content-between align-items-center">
                @if($item->type == \App\Enums\Categories\CategoryType::developerPolicy or $item->type == \App\Enums\Categories\CategoryType::developerGuide)
                    <a
                        href="{{ route('site.developer.show.category',['category' => $item->slug ]) }}">
                        {{ $item->title }}
                    </a>
                @else
                    <a
                        href="{{ route('site.show.category',['category' => $item->slug ]) }}">
                        {{ $item->title }}
                    </a>
                @endif

                <a class="d-flex justify-content-between collapsed click text-grey-7" data-toggle="collapse"
                   data-target="#collapse{{$item->id}}" aria-expanded="false"
                   aria-controls="collapse{{$item->id}}">
                    <i class="bx bx-chevron-up bx-sm text-right align-self-center icon"></i>
                </a>
            </div>

            <ul id="collapse{{$item->id}}"
                class="collapse mt-2 pt-3 text-grey-5 @isset($categoryId) @if($categoryId == $item->id) show  @endif @endisset"
                aria-labelledby="heading{{$item->id}}"
                data-parent="#{{$accordion}}" style="border-top: 1px solid lightgray !important;">

                @foreach($item->$relationName as $relation)
                    <li class="cursor-pointer mb-3 ">
                        <a href="{{ route($route , ['category' => $item->slug ,'article' => $relation->slug ]) }} "
                           @isset($article)
                           @if($relation->id == $article->id) style="font-weight: bold !important;" @endif
                           @endisset

                           class="yekan-regular">
                            {{ $relation->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>
