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

                                            @forelse ($roles as $role)
                                                <tr>
                                                    <td>{{ $role->fa_name }}</td>
                                                    <td>{{ $role->en_name }}</td>
                                                    <td>
                                                        @foreach($role->permissions as $permission )
                                                            @include('frest-components.badge' , ['badgeClass' => 'badge-danger', 'content' => $permission->fa_name ])
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $role->jalali_created_at }}</td>
                                                    <td>
                                                        @include('frest-components.icon-btn',[  'href' => route('admin.role.show',[ 'role' => $role->id ])  , 'tooltip_title' => __('global.edit') , 'icon' => warningPencilIcon() ])
                                                        @if($role->id !== $mainRoleId)
                                                            @include('frest-components.icon-btn',[ 'tooltip_title' => __('global.delete') , 'icon' => dangerTrashIcon() , 'attributes' => 'onclick=role_delete(this,event)  data-url='.route('admin.role.delete',[ 'role' => $role->id ]) ])
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                @include('custom-components.admin.empty-table')
                                            @endforelse

                                            </tbody>
                                        </table>

                                        @include('frest-components.pagination',['model' => $roles])

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

        function role_delete(element, event) {
            event.preventDefault()
            mboxDelete(element.getAttribute('data-url'));
        }

    </script>
@endsection
