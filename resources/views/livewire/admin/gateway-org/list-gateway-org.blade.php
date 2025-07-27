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

                                            @forelse ($gatewayOrgs as $gatewayOrg)
                                                <tr>

                                                    <td class="text-white">{{ $gatewayOrg->label }}</td>
                                                    <td class="text-white">{{ $gatewayOrg->gate->name }}</td>
                                                    <td>
                                                        @include('frest-components.badge' , [ 'badgeClass' => $gatewayOrg->is_active_badge_class,  'content' => $gatewayOrg->is_active_label ])
                                                    </td>
                                                    <td>
                                                        @if($gatewayOrg->is_default->value)
                                                            <i class="bx bx-check-circle text-success"></i>
                                                        @else
                                                            <i class="bx bx-x-circle text-danger"></i>
                                                        @endif
                                                    </td>
                                                    <td class="text-white">{{ $gatewayOrg->jalali_created_at }}</td>
                                                    <td>
                                                        @include('frest-components.icon-btn',[  'href' => route('admin.gateway-org.show',[ 'gate_org' => $gatewayOrg->id ])  , 'tooltipTitle' => __('global.edit') , 'icon' => warningPencilIcon() ])
                                                    </td>
                                                </tr>
                                            @empty
                                                @include('custom-components.admin.empty-table')
                                            @endforelse

                                            </tbody>
                                        </table>

                                        @include('frest-components.pagination',['model' => $gatewayOrgs] )

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
@endsection
