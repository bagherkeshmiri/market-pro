@section('title',$pageTitle)


@section('styles')
    <link rel="stylesheet" type="text/css" href=" {{ asset('/frest/vendors/css/extensions/sweetalert2.min.css') }}">
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

            <!-- // Basic multiple Column Form section start -->
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">

                                    <!-- Table with no outer spacing -->
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-hover">
                                            <thead>
                                            <tr>
                                                <th>نام</th>
                                                <th> ایمیل</th>
                                                <th>موبایل</th>
                                                @if($isAdmin)
                                                    <th>دسترسی ها</th>
                                                @endif
                                                <th>تاریخ ایجاد</th>
                                                <th>عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @forelse ($users as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td></td>
                                                    @if($isAdmin)
                                                        <td>
                                                            @foreach($user->permissions as $permission)
                                                                @include('frest-components.badges.secondary-badge' , [ 'content' => $permission->fa_name ])

                                                            @endforeach
                                                        </td>
                                                    @endif
                                                    <td>{{ jalali($user->created_at) }}</td>
                                                    <td>
                                                        {{--                                                        @can('edit')--}}
                                                        @include('frest-components.inputs.buttons.tiny.link.icon-btn',[  'href' => route('admin.user.show',[ 'admin' => $user->id ])  , 'tooltip_title' => __('global.edit') , 'icon' => warningPencilIcon() ])
                                                        {{--                                                        @endcan--}}
                                                        @if($user->id != $mainAdminId)
                                                            {{--                                                            @can('delete')--}}
                                                            @include('frest-components.inputs.buttons.tiny.link.icon-btn',[ 'tooltip_title' => __('global.delete') , 'icon' => dangerTrashIcon() , 'attributes' => 'onclick=account_delete(this,event)  data-url='.route('admin.user.delete',[ 'admin' => $user->id ]) ])
                                                            {{--                                                            @endcan--}}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="100" class="text-center"> {{ __('global.no_information_found') }}</td>
                                                </tr>
                                            @endforelse

                                            </tbody>
                                        </table>

                                        @include('frest-components.paginators.bootstrap',['model' => $users] )

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic multiple Column Form section end -->

        </div>
    </div>
</div>


@section('scripts')
    <script type="text/javascript" src="{{ asset('frest/js/scripts/extensions/sweet-alerts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frest/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/swal-functions.js') }}"></script>
    <script type="text/javascript">

        function account_delete(element, event) {
            event.preventDefault()
            mboxDelete(element.getAttribute('data-url'));
        }

    </script>
@endsection
