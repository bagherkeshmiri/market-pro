@section('title',$pageTitle)


@section('styles')
    <link rel="stylesheet" type="text/css" href=" {{ asset('/frest/vendors/css/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/vendors/css/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/css/plugins/extensions/toastr.css') }}">
@endsection

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h5 class="content-header-title float-left pr-1 text-success "
                            style=" border-left: 0 !important;">{{ $pageTitle }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">

            <!-- // Basic multiple Column Form section start -->
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">

                                    <!-- Table with no outer spacing -->
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-hover">
                                            <thead>
                                            <tr>
                                                @foreach($tableHeads as $tableHead)
                                                    <th>{{ $tableHead }}</th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @forelse ($categories as $category)
                                                <tr>
                                                    <td>{{ $category->title }}</td>
                                                    <td>{{ $category->seo_title }}</td>
                                                    <td>{{ $category->en_title }}</td>
                                                    <td id="copyLink{{$category->id}}" data-value="{{$category->slug}}" data-type="{{$category->type}}">{{ $category->slug }}</td>
                                                    <td>
                                                        @if($category->parent != null)
                                                            {{ $category->parent->title }}
                                                        @endif
                                                    </td>
                                                    <td>{!! $category->getBadgeType() !!}</td>
                                                    <td>{{ $category->created_at }}</td>
                                                    <td>
                                                        @include('frest-components.inputs.buttons.tiny.link.icon-btn',[  'href' => route('admin.category.show',[ 'category' => $category->slug ])  , 'tooltip_title' => __('global.edit') , 'icon' => warningPencilIcon() ])
                                                        @include('frest-components.inputs.buttons.tiny.link.icon-btn',[ 'tooltip_title' => __('global.delete') , 'icon' => dangerTrashIcon() , 'attributes' => 'onclick=category_delete(this,event)  data-url='.route('admin.category.delete',[ 'category' => $category->slug ]) ])
                                                        @include('frest-components.inputs.buttons.tiny.link.icon-btn',[ 'tooltip_title' => __('global.copy_link') , 'icon' => copyIcon() , 'attributes' => ' onclick=copyLink("copyLink'.$category->id.'") ' ])
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="100" class="text-center"> {{ __('global.no_information_found') }}</td>
                                                </tr>
                                            @endforelse

                                            </tbody>
                                        </table>

                                        @include('frest-components.paginators.bootstrap',['model' => $categories] )

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic multiple Column Form section end -->

        </div>
    </div>
</div>


@section('scripts')
    <script type="text/javascript" src="{{ asset('frest/js/scripts/extensions/sweet-alerts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frest/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/swal-functions.js') }}"></script>
    <script src="{{ asset('frest/vendors/js/extensions/toastr.min.js') }}"></script>
{{--    <script type="text/javascript">--}}

        {{--let userPolicy = @js(\App\Enums\Categories\CategoryType::userPolicy),--}}
        {{--    userGuide = @js(\App\Enums\Categories\CategoryType::userGuide),--}}
        {{--    developerGuide = @js(\App\Enums\Categories\CategoryType::developerGuide),--}}
        {{--    developerPolicy = @js(\App\Enums\Categories\CategoryType::developerPolicy),--}}
        {{--    url = '';--}}

        {{--function category_delete(element, event) {--}}
        {{--    event.preventDefault()--}}
        {{--    mboxDelete(element.getAttribute('data-url'));--}}
        {{--}--}}

        {{--const copyLink = (inputId) => {--}}
        {{--    let element = document.getElementById(inputId);--}}
        {{--    let type = Number(element.getAttribute('data-type'));--}}

        {{--    url = (type === developerPolicy || type === developerGuide)--}}
        {{--        ? window.location.origin + '/developer/' + element.getAttribute('data-value')--}}
        {{--        : window.location.origin + '/' + element.getAttribute('data-value');--}}

        {{--    navigator.clipboard.writeText(url);--}}
        {{--    toastr.success('لینک کوتاه کپی شد', {--}}
        {{--        rtl: true,--}}
        {{--        positionClass: 'toast-top-right'--}}
        {{--    });--}}
        {{--}--}}

{{--    </script>--}}
@endsection
