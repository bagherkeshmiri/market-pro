<div>
    <div class="row">
        <div class="col-sm-12 col-xs-12 col-md-8 col-lg-6 col-xl-6 col-xxl-4">
            @include('frest-components.rgba-alert', [
                'classes' => 'bg-rgba-info',
                'content' => 'تمامی مبالغ به تومان هستند',
                'icon'    => starIcon(),
            ])
        </div>
    </div>

    <div class="table-responsive">
        <table class="table mb-0 table-hover">
            <thead>
            <tr>
                @foreach($paymentTableHeads as $paymentTableHead)
                    <th>{{ $paymentTableHead }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody class="font-13">

            @forelse ($payments as $payment)
                <tr>
                    <td class="text-white">{{ $payment->order->order_number }}</td>
                    <td class="text-white">{{ $payment->gateOrg->label }}</td>
                    <td class="text-white">{{ $payment->payment_number }}</td>
                    <td>
                        @include('frest-components.badge' , [ 'badgeClass' => $payment->status_badge_class,  'content' => $payment->status_label ])
                    </td>
                    <td class="text-white">{{ number_format($payment->amount) }}</td>
                    <td class="text-white">{{ $payment->ref_id }}</td>
                    <td class="text-white">{{ $payment->jalali_paid_at }}</td>
                    <td class="text-white">{{ $payment->jalali_created_at }}</td>
                    <td class="text-white"></td>
                </tr>

            @empty
                @include('custom-components.admin.empty-table')
            @endforelse

            </tbody>
        </table>

        {{ $payments->links('frest-components.pagination',['elements' => $payments]) }}

    </div>
</div>
