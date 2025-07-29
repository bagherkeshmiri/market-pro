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


                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                               aria-controls="home" role="tab" aria-selected="true">
                                                <i class="bx bx-home align-middle"></i>
                                                <span class="align-middle">اطلاعات</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#payments"
                                               aria-controls="payments" role="tab" aria-selected="false">
                                                <i class="bx bxs-credit-card align-middle"></i>
                                                <span class="align-middle">پرداخت ها</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="about-tab" data-toggle="tab" href="#orders"
                                               aria-controls="orders" role="tab" aria-selected="false">
                                                <i class="bx bx-money align-middle"></i>
                                                <span class="align-middle">سفارش‌ها</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home" aria-labelledby="home-tab"
                                             role="tabpanel">
                                            @include('frest-components.flash-message')


                                            <form class="form" wire:submit.prevent="update">

                                                <div class="form-body">
                                                    <div class="row">

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'name' , 'content' => 'نام '] )
                                                                @include('frest-components.input',[ 'type' => 'text' , 'wire' => 'name' , 'classes' => 'text-left' , 'id' => 'name' , 'icon' => userIcon() , 'tabindex' => '1' , 'attributes' => 'required' ])
                                                                @include('frest-components.validation-error',[ 'name' => 'name' ])
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'email' , 'content' => 'ایمیل '] )
                                                                @include('frest-components.required-tag')
                                                                @include('frest-components.input',[ 'type' => 'text' , 'wire' => 'email' , 'classes' => 'text-left' , 'id' => 'email' , 'icon' => emailIcon() , 'tabindex' => '4' , 'attributes' => 'required' ])
                                                                @include('frest-components.validation-error',[ 'name' => 'email' ])
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'mobile' , 'content' => 'موبایل '] )
                                                                @include('frest-components.input',[ 'type' => 'number' , 'wire' => 'mobile' , 'classes' => 'text-left' , 'id' => 'mobile' , 'icon' => mobileIcon() , 'tabindex' => '4' , 'attributes' => 'required' ])
                                                                @include('frest-components.validation-error',[ 'name' => 'mobile' ])
                                                            </div>
                                                        </div>

                                                        <div class="col-12 d-flex justify-content-end">
                                                            @include('frest-components.submit-button', [ 'classes' => 'btn btn-primary mr-1 mb-1' , 'id' => 'save_btn' , 'content' => __('global.save')  , 'icon' => saveIcon() ])
                                                            @include('frest-components.link-button',[ 'href' =>  route('admin.user.index'), 'classes' => 'btn btn-danger mr-1 mb-1' , 'id' => 'cancel' , 'content' => __('global.cancel')  , 'icon' => arrowIcon() ])
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                        <div class="tab-pane" id="payments" aria-labelledby="profile-tab"
                                             role="tabpanel">
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

                                                @include('frest-components.pagination',['model' => $payments] )

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="orders" aria-labelledby="about-tab" role="tabpanel">
                                            <p>
                                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
                                                از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و
                                                سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای
                                                متنوع با هدف
                                            </p>
                                        </div>
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
