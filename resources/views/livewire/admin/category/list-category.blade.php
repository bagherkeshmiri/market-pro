@section('title',$pageTitle)


@section('styles')
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/frest/vendors/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/vendors/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frest/plugins/extensions/toastr.css') }}">
@endsection

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        @include('custom-components.admin.page-title',['pageTitle' => $pageTitle,])
        <div class="content-body">

            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
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
                                            <tbody>

                                            @forelse ($categories as $category)
                                                <tr>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->parent->name ?? ' - ' }}</td>
                                                    <td>{{ $category->jalali_created_at }}</td>
                                                    <td>
                                                        @include('frest-components.icon-btn',[  'href' => route('admin.category.show',[ 'category' => $category->id ])  , 'tooltip_title' => __('global.edit') , 'icon' => warningPencilIcon() ])
                                                        @include('frest-components.icon-btn',[ 'tooltip_title' => __('global.delete') , 'icon' => dangerTrashIcon() , 'attributes' => 'onclick=category_delete(this,event)  data-url='.route('admin.category.delete',[ 'category' => $category->id ]) ])
                                                    </td>
                                                </tr>
                                            @empty
                                                @include('custom-components.admin.empty-table')
                                            @endforelse

                                            </tbody>
                                        </table>

                                        @include('frest-components.pagination',['model' => $categories] )

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
    <script type="text/javascript">

        function category_delete(element, event) {
            event.preventDefault()
            mboxDelete(element.getAttribute('data-url'));
        }

    </script>
@endsection
