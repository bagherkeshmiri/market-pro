@section('title',$pageTitle)


@section('styles')
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

                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12 col-md-8 col-lg-6 col-xl-6 col-xxl-4">
                                            @include('frest-components.rgba-alert',['classes' => 'bg-rgba-success' , 'icon' => starIcon()])
                                        </div>
                                    </div>

                                    <div class=" justify-content-end mb-1 d-none" style="gap: 0.5rem;" id="sort-actions">
                                        <button id="save-order-btn" class="btn btn-warning btn-sm">ذخیره ترتیب</button>
                                        <button id="cancel-order-btn" class="btn btn-danger btn-sm">انصراف</button>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table mb-0 table-hover" style="cursor:pointer;">
                                            <thead>
                                            <tr>
                                                @foreach($tableHeads as $tableHead)
                                                    <th>{{ $tableHead }}</th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody class="font-13" id="collection-list-table">

                                            @forelse ($collections as $collection)

                                                <tr data-id="{{ $collection->id }}">
                                                    <td class="text-white">{{ $collection->title }}</td>
                                                    <td>
                                                        @include('frest-components.badge' , [ 'badgeClass' => $collection->type_badge_class,  'content' => $collection->type_label ])
                                                    </td>
                                                    <td>
                                                        @include('frest-components.badge' , [ 'badgeClass' => $collection->is_active_badge_class,  'content' => $collection->is_active_label ])
                                                    </td>
                                                    <td class="text-white">{{ $collection->limitation }}</td>
                                                    <td class="text-white">{{ $collection->jalali_created_at }}</td>
                                                    <td>
                                                        @include('frest-components.icon-btn',[  'href' => route('admin.collection.show',[ 'collection' => $collection->id ])  , 'tooltip_title' => __('global.edit') , 'icon' => warningPencilIcon() ])
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

    <script type="text/javascript">

        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('collection-list-table');
            const saveBtn = document.getElementById('save-order-btn');
            const cancelBtn = document.getElementById('cancel-order-btn');
            const actionsDiv = document.getElementById('sort-actions');

            let originalOrder = [];

            function captureOriginalOrder() {
                originalOrder = Array.from(container.querySelectorAll('tr')).map(tr => tr);
            }

            function restoreOriginalOrder() {
                container.innerHTML = '';
                originalOrder.forEach(tr => container.appendChild(tr));
            }

            captureOriginalOrder();

            dragula([container]).on('drop', function () {
                actionsDiv.classList.remove('d-none');
                actionsDiv.classList.add('d-flex');
            });

            saveBtn.addEventListener('click', function () {
                let ids = [];
                container.querySelectorAll('tr').forEach(tr => {
                    ids.push(tr.getAttribute('data-id'));
                });

                @this.
                call('updateOrder', ids);

                actionsDiv.classList.add('d-none');
                actionsDiv.classList.remove('d-flex');
                captureOriginalOrder();
            });

            cancelBtn.addEventListener('click', function () {
                restoreOriginalOrder();

                actionsDiv.classList.add('d-none');
                actionsDiv.classList.remove('d-flex');
            });
        });

    </script>
@endsection
