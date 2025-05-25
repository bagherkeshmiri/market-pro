@section('title',$category->title)

@section('styles')
@endsection


@section('side-menu')
    @include('livewire.site.side-menu',['items' => $data , 'relationName' => $relationName ,'accordion' => 'accordion' , 'route' => $route ])
@endsection

<div>
    @include('livewire.site.overlay-menu',[ 'menuTitle' => $category->title ,'items' => $data , 'relationName' => $relationName, 'route' => $route ])

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding-right: 0;">
            @include('frest-components.breadcrumb.simple-breadcrumb',['items' => ['اناردونی' , $category->title] ])
            @include('livewire.site.category-details')
        </div>
    </div>
</div>

@section('scripts')
@endsection
