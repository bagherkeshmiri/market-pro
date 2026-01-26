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
                                                'classes' => 'bg-rgba-warning',
                                                'content' => 'بعد از بروزرسانی مقادیر تنظیمات بروزرسانی حافظه کش لازم است',
                                                'icon'    => starIcon(),
                                            ])
                                        </div>

                                        <div class="col-sm-12 col-xs-12 col-md-8 col-lg-6 col-xl-6 col-xxl-4">
                                            <button type="button" class="btn btn-primary glow mr-1 mb-1">
                                                <i class="bx bx-rotate-right"></i>
                                                <span class="align-middle ml-25">بروزرسانی کش</span>
                                            </button>
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

                                            @forelse ($systemSettings as $systemSetting)
                                                <tr>
                                                    <td class="text-white">{{ $systemSetting->label }}</td>
                                                    <td class="text-white">{{ $systemSetting->key }}</td>
                                                    <td class="text-white">{{ $systemSetting->value }}</td>

                                                    <td>
                                                        @include('frest-components.badge' , [ 'badgeClass' => $systemSetting->type_badge_class ,  'content' => $systemSetting->type_label  ])
                                                    </td>

                                                    <td class="text-white">{{ $systemSetting->jalali_created_at }}</td>
                                                    <td>
                                                        @include('frest-components.icon-btn',[  'href' => route('admin.system-setting.show',[ 'systemSetting' => $systemSetting->id ])  , 'tooltipTitle' => __('global.edit') , 'icon' => warningPencilIcon() ])
                                                    </td>
                                                </tr>

                                            @empty
                                                @include('custom-components.admin.empty-table')
                                            @endforelse

                                            </tbody>
                                        </table>

                                        {{ $systemSettings->links('frest-components.pagination',['elements' => $systemSettings]) }}

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
