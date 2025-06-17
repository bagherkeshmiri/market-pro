@section('title',$pageTitle)


@section('styles')
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/frest/vendors/extensions/sweetalert2.min.css') }}">
@endsection


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
{{--        @include('custom-components.admin.page-title',['pageTitle' => $pageTitle,])--}}
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
                                            <tbody class="font-13">

                                            @forelse ($users as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        @include('frest-components.badge' , [ 'badgeClass' => 'badge-danger',  'content' => $user->role->fa_name ])
                                                    </td>
                                                    <td>
                                                        @include('frest-components.badge' , [ 'badgeClass' => 'badge-success',  'content' => $user->type_label ])
                                                    </td>
                                                    @if($isAdmin)
                                                        <td>
                                                            @foreach($user->permissions as $permission)
                                                                @include('frest-components.badge' , [ 'badgeClass' => 'badge-secondary',  'content' => $permission->fa_name ])
                                                            @endforeach
                                                        </td>
                                                    @endif
                                                    <td>{{ $user->jalali_created_at }}</td>
                                                    <td>
                                                        @include('frest-components.icon-btn',[  'href' => route('admin.user.show',[ 'admin' => $user->id ])  , 'tooltip_title' => __('global.edit') , 'icon' => warningPencilIcon() ])
                                                        @if($user->id != $mainAdminId)
                                                            @include('frest-components.icon-btn',[ 'tooltip_title' => __('global.delete') , 'icon' => dangerTrashIcon() , 'attributes' => 'onclick=account_delete(this,event)  data-url='.route('admin.user.delete',[ 'admin' => $user->id ]) ])
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                @include('custom-components.admin.empty-table')
                                            @endforelse

                                            </tbody>
                                        </table>

                                        @include('frest-components.pagination',['model' => $users] )

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
    <script type="text/javascript">

        function account_delete(element, event) {
            event.preventDefault()
            mboxDelete(element.getAttribute('data-url'));
        }

    </script>
@endsection
