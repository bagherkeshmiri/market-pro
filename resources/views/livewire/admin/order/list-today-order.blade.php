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
                                                @foreach($tableHeads as $tableHead)
                                                    <th>{{ $tableHead }}</th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody class="font-13">

                                            @forelse ($orders as $order)
                                                <tr>
                                                    <td class="text-white">
                                                        <a class="text-white"
                                                           href="{{ route('admin.user.show',['user' => $order->user->id]) }}">
                                                            {{ $order->user->name }}
                                                        </a>
                                                    </td>
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

                                        @include('frest-components.pagination',['model' => $orders] )

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
