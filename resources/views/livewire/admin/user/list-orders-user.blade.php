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
                @foreach($orderTableHeads as $orderTableHead)
                    <th>{{ $orderTableHead }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody class="font-13">

            @forelse ($orders as $order)
                <tr>
                    <td class="text-white">{{ $order->order_number }}</td>
                    <td>
                        @include('frest-components.badge' , [ 'badgeClass' => $order->status_badge_class,  'content' => $order->status_label ])
                    </td>
                    <td class="text-white">{{ number_format($order->subtotal)}}</td>
                    <td class="text-white">{{ number_format($order->discount)}}</td>
                    <td class="text-white">{{ number_format($order->tax)}}</td>
                    <td class="text-white">{{ number_format($order->shipping_fee)}}</td>
                    <td class="text-white">{{ number_format($order->total)}}</td>
                    <td class="text-white">{{ $order->jalali_created_at }}</td>
                </tr>

            @empty
                @include('custom-components.admin.empty-table')
            @endforelse

            </tbody>
        </table>

        {{ $orders->links('frest-components.livewire-pagination',['elements' => $orders]) }}

    </div>
</div>
