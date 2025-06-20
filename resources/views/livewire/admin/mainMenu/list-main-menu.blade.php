@section('title',' لیست منوها')


@section('styles')
    <link rel="stylesheet" type="text/css" href=" {{ asset('/frest/vendors/css/extensions/sweetalert2.min.css') }}">
@endsection

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
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
                                                <th>عنوان</th>
                                                <th>آدرس</th>
                                                <th>وضعیت</th>
                                                <th>تاریخ ایجاد</th>
                                                <th>عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @forelse ($allmainMenus as $menu)
                                                <tr>
                                                    <td>{{ $menu->key }}</td>
                                                    <td>{{ $menu->value }}</td>
                                                    <td>
                                                        @if($menu->is_active == $active)
                                                            @include('frest-components.badge' , [ 'badgeClass' => 'bg-rgba-success text-success' ,'content' => __('global.active') ])
                                                        @else
                                                            @include('frest-components.badge' , ['badgeClass' => 'bg-rgba-danger text-danger' , 'content' => __('global.in_active') ])
                                                        @endif
                                                    </td>
                                                    <td>{{ $menu->created_at }}</td>
                                                    <td>

                                                        @if($menu->is_active == $active)
                                                            @can('disable')
                                                                @include('frest-components.icon-btn',[ 'tooltip_title' => 'غیرفعالسازی' , 'icon' => dangerXIcon() , 'attributes' => 'onclick=menu_disable(this,event)  data-url='.route('admin.main_menu.disable',[ 'main_menu' =>  $menu->id  ]) ])
                                                            @endcan
                                                        @else
                                                            @can('enable')
                                                                @include('frest-components.icon-btn',[ 'tooltip_title' => 'فعالسازی' , 'icon' => successCheckIcon() , 'attributes' => 'onclick=menu_enable(this,event)  data-url='.route('admin.main_menu.enable',[ 'main_menu' =>  $menu->id  ]) ])
                                                            @endcan
                                                        @endif

                                                        @can('edit')
                                                            @include('frest-components.icon-btn',[  'href' => route('admin.main_menu.show',[ 'main_menu' => $menu->id ])  , 'tooltip_title' => __('global.edit') , 'icon' => warningPencilIcon() ])
                                                        @endcan
                                                        @can('delete')
                                                            @include('frest-components.icon-btn',[ 'tooltip_title' => __('global.delete') , 'icon' => dangerTrashIcon() , 'attributes' => 'onclick=menu_delete(this,event)  data-url='.route('admin.main_menu.delete',[ 'main_menu' =>  $menu->id  ]) ])
                                                        @endcan

                                                    </td>
                                                </tr>
                                            @empty
                                                @include('custom-components.admin.empty-table')
                                            @endforelse

                                            </tbody>
                                        </table>

                                        @include('frest-components.pagination',['model' => $allmainMenus] )

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
    <script type="text/javascript">

        function menu_delete(element, event) {
            event.preventDefault()
            mboxDelete(element.getAttribute('data-url'));
        }

        function menu_enable(element, event) {
            event.preventDefault()
            mboxActive(element.getAttribute('data-url'));
        }

        function menu_disable(element, event) {
            event.preventDefault()
            mboxInActive(element.getAttribute('data-url'));
        }

    </script>
@endsection
