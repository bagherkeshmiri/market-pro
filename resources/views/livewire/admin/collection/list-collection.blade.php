@section('title',$pageTitle)


@section('styles')
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/frest/vendors/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/vendors/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/plugins/extensions/toastr.css') }}">
@endsection

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-body">

            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card border ">
                            <div class="card-content">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table mb-0 table-hover">
                                            <thead>
                                            <tr>
                                                @foreach($tableHeads as $tableHead)
                                                    <th>{{ $tableHead }}</th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody class="font-13">

                                            @forelse ($collections as $collection)

                                                <tr>
                                                    <td class="text-white">{{ $collection->title }}</td>
                                                    <td>
                                                        @include('frest-components.badge' , [ 'badgeClass' => $collection->type_badge_class,  'content' => $collection->type_label ])
                                                    </td>
                                                    <td>
                                                        @include('frest-components.badge' , [ 'badgeClass' => $collection->is_active_badge_class,  'content' => $collection->is_active_label ])
                                                    </td>
                                                    <td class="text-white">{{ $collection->limitation }}</td>
                                                    <td class="text-white">{{ $collection->sort }}</td>
                                                    <td class="text-white">{{ $collection->jalali_created_at }}</td>
                                                    <td>
                                                        @include('frest-components.icon-btn',[  'href' => route('admin.product.show',[ 'product' => $collection->id ])  , 'tooltip_title' => __('global.edit') , 'icon' => warningPencilIcon() ])
                                                    </td>
                                                </tr>

                                            @empty
                                                @include('custom-components.admin.empty-table')
                                            @endforelse

                                            </tbody>
                                        </table>

                                        @include('frest-components.pagination',['model' => $collections] )

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
    </div>
</div>


@section('scripts')
    <script type="text/javascript" src="{{ asset('js/frest/scripts/extensions/sweet-alerts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/frest/vendors/extensions/sweetalert2.all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/swal-functions.js') }}"></script>
    <script src="{{ asset('js/frest/vendors/extensions/toastr.min.js') }}"></script>
    {{--    <script type="text/javascript">--}}

    // function product_delete(element, event) {
    //     event.preventDefault()
    //     mboxDelete(element.getAttribute('data-url'));
    // }

    {{--    </script>--}}
@endsection
