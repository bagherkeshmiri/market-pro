@section('title',$pageTitle)


@section('styles')
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
                                                    <td>
                                                        @include('frest-components.badge' , [ 'badgeClass' => $product->status_badge_class,  'content' => $product->status_label ])
                                                    </td>
                                                    <td>{{ $product->formatted_price }}</td>
                                                    <td>{{ $product->stock }}</td>
                                                    <td>{{ $product->jalali_created_at }}</td>
                                                    <td>
                                                        @include('frest-components.icon-btn',[  'href' => route('admin.product.show',[ 'product' => $product->id ])  , 'tooltip_title' => __('global.edit') , 'icon' => warningPencilIcon() ])
                                                        @include('frest-components.icon-btn',[ 'tooltip_title' => __('global.delete') , 'icon' => dangerTrashIcon() , 'attributes' => 'onclick=product_delete(this,event)  data-url='.route('admin.product.delete',[ 'product' => $product->id ]) ])
                                                    </td>
                                                </tr>

                                                @include('frest-components.modal',['modalTitle' => 'تصویر اصلی', 'modalId' =>$modalId ])

                                            @empty
                                                <tr>
                                                    <td colspan="100" class="text-center"> {{ __('global.no_information_found') }}</td>
                                                </tr>
                                            @endforelse

                                            </tbody>
                                        </table>

                                        @include('frest-components.bootstrap',['model' => $products] )

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
    <script type="text/javascript">

        function product_delete(element, event) {
            event.preventDefault()
            mboxDelete(element.getAttribute('data-url'));
        }

    </script>
@endsection
