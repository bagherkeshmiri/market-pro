<div class="row align-items-center font-size-12 text-grey-5">
    <ul class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        @foreach($items as $item)
            <li class="d-inline align-self-center">{{ $item }}</li>
            @if(!$loop->last)
                <li class="d-inline align-self-center">
                    <i class="bx bx-chevron-left " style="position: relative; top: 4px;"></i>
                </li>
            @endif

        @endforeach
    </ul>
</div>
