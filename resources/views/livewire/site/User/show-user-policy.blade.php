@section('title',$article->title)

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/vendors/css/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/css/plugins/extensions/toastr.css') }}">
@endsection

@section('side-menu')
    @include('livewire.site.side-menu',['items' => $politics , 'relationName' => 'articlesUserPolicy','accordion' => 'accordion' , 'route' => 'site.show.policy'])
@endsection

<div>
    @include('livewire.site.overlay-menu',['menuTitle' => $article->title ,'items' => $politics , 'relationName' => 'articlesUserPolicy', 'route' => 'site.show.policy'])

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding-right: 0;">
            @include('frest-components.breadcrumb.simple-breadcrumb',['items' => ['اناردونی' , $categoryTitle , $article->title] ])
            @include('livewire.site.details')
        </div>
    </div>
</div>


@section('scripts')
    <script src="{{ asset('frest/vendors/js/extensions/toastr.min.js') }}"></script>
    <script>
        const copyLink = (inputId) => {
            let element = document.getElementById(inputId);
            let url = window.location.origin + '/r/' + element.getAttribute('data-value');
            navigator.clipboard.writeText(url);
            toastr.success('لینک کوتاه کپی شد', {
                rtl: true,
                positionClass: 'toast-top-right'
            });
        }

        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
