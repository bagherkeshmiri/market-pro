
@section('styles')
@endsection

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-body">

            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card border">
                            <div class="card-content">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12 col-md-8 col-lg-6 col-xl-6 col-xxl-4">
                                            @include('frest-components.rgba-alert', [
                                                'classes' => 'bg-rgba-info',
                                                'content' => 'تمامی مبالغ به تومان هستند',
                                                'icon'    => starIcon(),
                                            ])
                                        </div>
                                    </div>

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

                                            @forelse ($products as $product)

                                                @php
                                                    $modalId = 'mainImageModal' . $product->id;
                                                @endphp

                                                <tr>
                                                    <td data-toggle="tooltip" data-placement="top" title="  برای نمایش تصویر روی آن کلیک کنید">
                                                        <img data-toggle="modal" data-target="#{{ $modalId }}" src="{{ $product->mainImage ? asset($product->mainImage->url) : asset($this->getSampleImageUrl()) }}" alt="product-image-{{ $product->id }}" width="40" height="40"/>
                                                    </td>
                                                    <td class="text-white">{{ $product->name }}</td>
                                                    <td class="text-white">{{ $product->category->name ?? ' - ' }}</td>
                                                    <td>
                                                        @include('frest-components.badge' , [ 'badgeClass' => $product->status_badge_class,  'content' => $product->status_label ])
                                                    </td>
                                                    <td>
                                                        @include('frest-components.badge' , [ 'badgeClass' => $product->discount_type_badge_class,  'content' => $product->discount_type_label ])
                                                    </td>
                                                    <td class="text-white">{{ $product->formatted_price }}</td>
                                                    <td class="text-white">{{ $product->formatted_discount }}</td>
                                                    <td class="text-white">{{ $product->formatted_final_price }}</td>
                                                    <td class="text-white">{{ $product->stock }}</td>
                                                    <td>
                                                        @include('frest-components.icon-btn',[  'href' => route('admin.product.show',[ 'product' => $product->id ])  , 'tooltipTitle' => __('global.edit') , 'icon' => warningPencilIcon() ])
                                                        @include('frest-components.icon-btn',[ 'tooltipTitle' => __('global.delete') , 'icon' => dangerTrashIcon() , 'attributes' => 'onclick=product_delete(this,event)  data-url='.route('admin.product.delete',[ 'product' => $product->id ]) ])
                                                    </td>
                                                </tr>

                                                @include('frest-components.image-preview-modal', [
                                                   'modelImageRelation'    => $product->mainImage,
                                                   'modelImageUrl'         => $product->mainImage->url ?? '',
                                                   'modalTitle'            => 'تصویر اصلی  محصول ' . $product->name,
                                                   'modalId'               => $modalId,
                                                   'sampleImageUrl' => $this->getSampleImageUrl(),
                                               ])

                                            @empty
                                                @include('custom-components.admin.empty-table')
                                            @endforelse

                                            </tbody>
                                        </table>

                                        @include('frest-components.pagination',['model' => $products] )

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

        function product_delete(element, event) {
            event.preventDefault()
            mboxDelete(element.getAttribute('data-url'));
        }

    </script>
@endsection
