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

                                            @forelse ($products as $product)

                                                @php
                                                    $mainImage = $product->images()->where('is_main', true)->first();
                                                    $mainImageUrl = $mainImage->image_url ?? asset('images/sample/sample-product.png');
                                                    $modalId = 'mainImageModal' . $product->id;
                                                @endphp

                                                <tr>
                                                    <td data-toggle="tooltip" data-placement="top" title="  برای نمایش تصویر روی آن کلیک کنید">
                                                        <img data-toggle="modal" data-target="#{{ $modalId }}" src="{{ $mainImageUrl }}" alt="product-image-{{ $product->id }}" width="40" height="40"/>
                                                    </td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->category->name ?? ' - ' }}</td>
                                                    <td>{{ number_format($product->price) }}</td>
                                                    <td>{{ $product->stock }}</td>
                                                    <td>{{ jalali($product->created_at) }}</td>
                                                    <td>
                                                        @include('frest-components.inputs.buttons.tiny.link.icon-btn',[  'href' => route('admin.category.show',[ 'category' => $product->id ])  , 'tooltip_title' => __('global.edit') , 'icon' => warningPencilIcon() ])
                                                        @include('frest-components.inputs.buttons.tiny.link.icon-btn',[ 'tooltip_title' => __('global.delete') , 'icon' => dangerTrashIcon() , 'attributes' => 'onclick=category_delete(this,event)  data-url='.route('admin.category.delete',[ 'category' => $product->id ]) ])
                                                    </td>
                                                </tr>

                                                @include('frest-components.inputs.modal',['modalTitle' => 'تصویر اصلی', 'modalId' =>$modalId ])

                                            @empty
                                                <tr>
                                                    <td colspan="100" class="text-center"> {{ __('global.no_information_found') }}</td>
                                                </tr>
                                            @endforelse

                                            </tbody>
                                        </table>

                                        @include('frest-components.paginators.bootstrap',['model' => $products] )

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
    <script type="text/javascript" src="{{ asset('frest/js/scripts/extensions/sweet-alerts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frest/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/swal-functions.js') }}"></script>
    <script src="{{ asset('frest/vendors/js/extensions/toastr.min.js') }}"></script>
    <script type="text/javascript">

        function category_delete(element, event) {
            event.preventDefault()
            mboxDelete(element.getAttribute('data-url'));
        }

    </script>
@endsection
