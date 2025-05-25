<div class="row" id="details">
    <div
        class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
        <h3 class="font-size-24 text-grey-7 d-inline">{{$article->title}}</h3>
        <i id="copyLink" data-value="{{$article->link}}" class="bx bx-share-alt d-inline bx-sm ml-1"
           style="position: relative; top: 4px; float: left; color: dodgerblue;" onclick="copyLink('copyLink')"
           data-toggle="tooltip" data-placement="top" title="{{ __('global.copy_link') }}"
        ></i>
        <div class="text-grey-5 font-size-16 mt-3">{!! $article->newContent !!}</div>
    </div>
</div>
