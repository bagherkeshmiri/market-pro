
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

                                            @forelse ($categories as $category)
                                                @php
                                                    $modalId = 'mainImageModal' . $category->id;
                                                @endphp


                                                <tr>
                                                    <td data-toggle="tooltip" data-placement="top" title="  برای نمایش تصویر روی آن کلیک کنید">
                                                        <img data-toggle="modal" data-target="#{{ $modalId }}" src="{{ $category->image ? asset($category->image->url) : asset($this->getSampleImageUrl()) }}" alt="category-image-{{ $category->id }}" width="40" height="40"/>
                                                    </td>
                                                    <td class="text-white">{{ $category->name }}</td>
                                                    <td class="text-white">{{ $category->parent->name ?? ' - ' }}</td>
                                                    <td>
                                                        @include('frest-components.badge' , [ 'badgeClass' => $category->type_badge_class ,  'content' => $category->type_label  ])
                                                    </td>
                                                    <td class="text-white">{{ $category->jalali_created_at }}</td>
                                                    <td>
                                                        @include('frest-components.icon-btn',[  'href' => route('admin.category.show',[ 'category' => $category->id ])  , 'tooltipTitle' => __('global.edit') , 'icon' => warningPencilIcon() ])
                                                        @include('frest-components.icon-btn',[ 'tooltipTitle' => __('global.delete') , 'icon' => dangerTrashIcon() , 'attributes' => 'onclick=category_delete(this,event)  data-url='.route('admin.category.delete',[ 'category' => $category->id ]) ])
                                                    </td>
                                                </tr>

                                                @include('frest-components.image-preview-modal', [
                                                    'modelImageRelation'    => $category->image,
                                                    'modelImageUrl'         => $category->image->url ?? '',
                                                    'modalTitle'            => 'تصویر اصلی دسته بندی ' . $category->name,
                                                    'modalId'               => $modalId,
                                                    'sampleProductImageUrl' => $this->getSampleImageUrl(),
                                                ])

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
