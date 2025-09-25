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

                                            @forelse ($discountCodes as $discountCode)
                                                <tr>

                                                    <td class="text-white">{{ $discountCode->code }}</td>
                                                    <td>
                                                        @include('frest-components.badge' , [ 'badgeClass' => $discountCode->type_badge_class ,  'content' => $discountCode->type_label  ])
                                                    </td>
                                                    <td>
                                                        @include('frest-components.badge' , [ 'badgeClass' => $discountCode->is_active_badge_class ,  'content' => $discountCode->is_active_label  ])
                                                    </td>
                                                    @if($discountCode->type == \App\Enums\DiscountType::Amount)
                                                        <td class="text-white">{{ number_format($discountCode->amount) }} </td>
                                                    @else
                                                        <td class="text-white">
                                                            {{ fmod($discountCode->amount, 1) == 0 ? intval($discountCode->amount) : $discountCode->amount }}
                                                        </td>
                                                    @endif
                                                    <td class="text-white">{{ $discountCode->usage_limit }}</td>
                                                    <td class="text-white">{{ $discountCode->used_count }}</td>
                                                    <td class="text-white">{{ number_format($discountCode->min_order_amount) }}</td>
                                                    <td class="text-white">{{ $discountCode->jalali_expire_at }}</td>
                                                    <td class="text-white">{{ $discountCode->jalali_created_at }}</td>
                                                    <td>
                                                        @include('frest-components.icon-btn',[  'href' => route('admin.discount.show',[ 'discount' => $discountCode->id ])  , 'tooltipTitle' => __('global.edit') , 'icon' => warningPencilIcon() ])
                                                    </td>
                                                </tr>

                                            @empty
                                                @include('custom-components.admin.empty-table')
                                            @endforelse

                                            </tbody>
                                        </table>

                                        {{ $discountCodes->links('frest-components.pagination',['elements' => $discountCodes]) }}

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
