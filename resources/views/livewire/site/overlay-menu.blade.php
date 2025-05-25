<div class="d-lg-none d-xl-none" id="menu-accordion">
    <div class="card mb-4 shadow" style="max-height: 292px;">
        <div class="card-header d-flex justify-content-between background-color-unset" id="main-heading1">
            <h5 class="mb-0 w-100">
                <button
                    class="btn btn-link collapsed non-text-decoration text-dark click text-left w-100 size-5 px-0 text-grey-9"
                    data-toggle="collapse"
                    data-target="#main-collapse1"
                    aria-expanded="false" aria-controls="main-collapse1">
                    {{ $menuTitle }}
                    <i class="bx bx-chevron-up bx-sm text-right align-self-center icon" style="float: left;"></i>
                </button>
            </h5>

        </div>
        <div id="main-collapse1" class="collapse" aria-labelledby="main-heading1"
             data-parent="#menu-accordion" style="overflow-y: scroll;">
            <hr class="my-solid-divider pb-0 pt-0" style="max-width: 98% !important;">
            <div class="card-body pt-0 size-4 text-grey-7">


                <ul class="none-style-ul p-0 text-left font-size-14" id="accordion-child">

                    @foreach($items as $item)
                        <li id="heading-child-{{$item->id}}" style="margin-bottom: 5px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('site.developer.show.category',['category' => $item->slug ]) }}">
                                    {{ $item->title }}
                                </a>
                                <a class="d-flex justify-content-between collapsed click text-grey-7"
                                   data-toggle="collapse"
                                   data-target="#collapse-child-{{$item->id}}" aria-expanded="false"
                                   aria-controls="collapse-child-{{$item->id}}">

                                    <i class="bx bx-chevron-up bx-sm text-right align-self-center icon"></i>
                                </a>
                            </div>


                            <ul id="collapse-child-{{$item->id}}"
                                class="collapse text-grey-5 @if($firstId == $item->id) show  @endif"
                                aria-labelledby="heading-child-{{$item->id}}"
                                data-parent="#accordion-child">

                                @foreach($item->$relationName as $relation)
                                    <li class="cursor-pointer mb-1 ">
                                        <a href="{{ route($route , ['category' => $item->slug , 'article' => $relation->slug ]) }}"
                                           class="yekan-regular">
                                            {{ $relation->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>


            </div>
        </div>
    </div>
</div>
