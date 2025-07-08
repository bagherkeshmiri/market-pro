<div class="card mb-4 ">
    <div class="card-header d-flex justify-content-between" id="heading{{$id}}">
        <h5 class="mb-0 w-100">
            <button class="btn btn-link collapsed non-text-decoration text-dark click text-left w-100 size-4 px-0 text-grey-9" data-toggle="collapse"
                    data-target="#collapse{{$id}}"
                    aria-expanded="false" aria-controls="collapse{{$id}}">
                {{ $title }}
                <i class="bx bx-chevron-up bx-sm text-right align-self-center icon" style="float: left;"></i>
            </button>
        </h5>

    </div>
    <div id="collapse{{$id}}" class="collapse @if($firstId == $id) show @endif" aria-labelledby="heading{{$id}}"
         data-parent="#{{$dataParent}}" >
        <hr class="my-solid-divider pb-0 pt-0" style="max-width: 98% !important;">
        <div class="card-body pt-0 size-4 text-grey-7 pb-0">
            <p>
                {!!  $content  !!}
            </p>

        </div>
    </div>
</div>
