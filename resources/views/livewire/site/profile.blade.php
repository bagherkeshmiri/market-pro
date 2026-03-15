@section('styles')
    <style>
        body {
            direction: rtl;
        }

        .profile-dashboard {
            display: flex;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            transition: 0.3s;
        }

        /* ========== Sidebar (Desktop) ========== */
        .profile-sidebar {
            width: 250px;
            background-color: #E53935;
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 20px 10px;
            flex-shrink: 0;
        }

        .profile-sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 500;
        }

        .profile-menu-item {
            background: none;
            border: none;
            color: #fff;
            font-size: 16px;
            padding: 12px 15px;
            text-align: right;
            cursor: pointer;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: 0.2s;
            white-space: nowrap;
        }

        /* !important : dont remove */
        .profile-menu-item:hover,
        .profile-menu-item.active {
            background-color: #c62828;
        }

        /* ========== Main Content ========== */
        .profile-content {
            flex: 1;
            padding: 30px;
            width: 100%;
        }

        .profile-content section {
            display: none;
            animation: fadeIn 0.3s ease-in-out;
        }

        /* !important : dont remove */
        .profile-content section.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .profile-h2 {
            color: #E53935;
            border-bottom: 2px solid #E53935;
            padding-bottom: 10px;
            margin-bottom: 25px;
            font-size: 20px;
        }

        .profile-card {
            background: #fafafa;
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            color: #333;
        }

        .profile-label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        /*input {*/
        /*    width: 100%;*/
        /*    padding: 10px;*/
        /*    border: 1px solid #ddd;*/
        /*    border-radius: 5px;*/
        /*    margin-bottom: 10px;*/
        /*    font-size: 14px;*/
        /*}*/

        .profile-button {
            background-color: #E53935;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            font-size: 15px;
        }

        .profile-button:hover {
            background-color: #c62828;
        }

        /* ========== Table Styling ========== */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            border-bottom: 1px solid #eee;
            padding: 12px 10px;
            text-align: center;
            min-width: 100px;
        }

        th {
            background-color: #E53935;
            color: #fff;
        }

        tr {
            color: #333;
        }

        /* ========== Responsive Design ========== */
        @media (max-width: 991px) {
            .profile-dashboard {
                flex-direction: column;
            }

            .profile-sidebar {
                width: 100%;
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
                padding: 10px;
                flex-wrap: wrap;
                height: auto;
            }

            .profile-sidebar h4 {
                display: none;
            }

            .profile-menu-item {
                flex: 1;
                min-width: 120px;
                text-align: center;
                font-size: 14px;
                padding: 10px;
                margin: 4px;
            }

            .profile-content {
                padding: 20px;
            }

            .profile-card {
                padding: 15px;
            }

            h2 {
                font-size: 18px;
            }

            input {
                font-size: 13px;
            }

            .profile-button {
                width: 100%;
            }
        }

        @media (max-width: 575px) {
            .profile-menu-item {
                font-size: 13px;
                padding: 8px;
                min-width: 100px;
                margin: 2px;
            }

            h2 {
                font-size: 16px;
            }

            th, td {
                font-size: 12px;
                padding: 8px 5px;
            }

            .profile-sidebar {
                justify-content: center;
            }
        }
    </style>
@endsection

<div class="profile-dashboard container mt-50 mb-50">

    <div class="profile-sidebar">
        <button class=" profile-button profile-menu-item {{ $activeSection === 'info' ? 'active' : '' }}" wire:click="showSection('info')">
            <i class="fa-sharp fa-regular fa-home pl-10"></i>
            اطلاعات
        </button>

        <button class=" profile-button profile-menu-item {{ $activeSection === 'payments' ? 'active' : '' }}" wire:click="showSection('payments')">
            <i class="fa-sharp fa-regular fa-dollar pl-10"></i>
            پرداخت‌ها
        </button>

        <button class=" profile-button profile-menu-item {{ $activeSection === 'orders' ? 'active' : '' }}" wire:click="showSection('orders')">
            <i class="fa-sharp fa-regular fa-list pl-10"></i>
            سفارشات
        </button>

        <button class=" profile-button profile-menu-item {{ $activeSection === 'password' ? 'active' : '' }}" wire:click="showSection('password')">
            <i class="fa-sharp fa-regular fa-lock pl-10"></i>
            رمز عبور
        </button>

        <a class="profile-menu-item" href="{{ route('logout') }}" style="color: #fff">
            <i class="fa-sharp fa-regular fa-power-off pl-10"></i>
            خروج
        </a>

    </div>

    <div class="profile-content">

        <section id="info" class="{{ $activeSection === 'info' ? 'active' : '' }}">
            <h2 class="profile-h2">اطلاعات کاربر</h2>
            <div class="profile-card col-12 p-3">
                <div class="row g-3">
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-2"><strong>نام و نام خانوادگی :</strong> {{ $user->name }}</div>
                        <div class="mb-2"><strong>ایمیل :</strong> {{ $user->email }}</div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-2"><strong>موبایل :</strong> {{ $user->mobile }}</div>
                        <div class="mb-2"><strong> تاریخ ثبت نام :</strong> {{ $user->jalali_created_at }}</div>
                    </div>
                </div>
            </div>
        </section>

        <section id="payments" class="{{ $activeSection === 'payments' ? 'active' : '' }}">
            <h2 class="profile-h2">پرداخت‌ها</h2>
            <div class="table-responsive">
                <table>
                    <thead>
                    <tr>
                        <th> شناسه پرداخت</th>
                        <th> شناسه سفارش</th>
                        <th> مبلغ</th>
                        <th> وضعیت</th>
                        <th> تاریخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($payments as $payment)
                        <tr>
                            <td>{{ $payment->payment_number }}</td>
                            <td>{{ $payment->order->order_number }}</td>
                            <td>{{ number_format($payment->amount) }} تومان</td>
                            <td>{{ $payment->status_label }}</td>
                            <td>{{ $payment->jalali_created_at }}</td>
                        </tr>
                    @empty
                        @include('custom-components.site.empty-table')
                    @endforelse
                    </tbody>
                </table>
                @if($payments->count() > $this->perPage)
                    {{ $payments->links('custom-components.site.pagination', ['items' => $payments]) }}
                @endif
            </div>
        </section>

        <section id="orders" class="{{ $activeSection === 'orders' ? 'active' : '' }}">
            <h2 class="profile-h2">سفارشات</h2>
            <div class="table-responsive">
                <table>
                    <thead>
                    <tr>
                        <th> شماره</th>
                        <th> تخفیف</th>
                        <th> مالیات</th>
                        <th> هزینه ارسال</th>
                        <th> جمع کل</th>
                        <th> وضعیت</th>
                        <th> تاریخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ number_format($order->discount) }} تومان</td>
                            <td>{{ number_format($order->tax) }} تومان</td>
                            <td>{{ number_format($order->shipping_fee) }} تومان</td>
                            <td>{{ number_format($order->total) }} تومان</td>
                            <td>{{ $order->status_label }}</td>
                            <td>{{ $order->jalali_created_at }}</td>
                        </tr>
                    @empty
                        @include('custom-components.site.empty-table')
                    @endforelse
                    </tbody>
                </table>
                @if($orders->count() > $this->perPage)
                    {{ $orders->links('custom-components.site.pagination', ['items' => $orders]) }}
                @endif
            </div>
        </section>

        <section id="password" class="{{ $activeSection === 'password' ? 'active' : '' }}">
            <h2 class="profile-h2">تغییر رمز عبور</h2>
            <div class="profile-card p-3">

                @include('custom-components.site.flash-message')

                <form wire:submit.prevent="changePassword">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="mb-3">
                                @include('custom-components.site.label', [
                                    'for' => 'currentPassword',
                                    'content' => 'رمز قبلی',
                                    'classes' => ''
                                ])
                                @include('custom-components.site.required-tag')

                                @include('custom-components.site.input', [
                                    'type' => 'password',
                                    'wire' => 'currentPassword',
                                    'classes' => '',
                                    'id' => 'current_password',
                                    'attributes' => 'required',
                                ])

                                @include('custom-components.site.validation-error', [
                                    'name' => 'currentPassword',
                                ])

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">

                                @include('custom-components.site.label', [
                                   'for' => 'new_password',
                                   'content' => 'رمز جدید',
                                   'classes' => ''
                               ])
                                @include('custom-components.site.required-tag')

                                @include('custom-components.site.input', [
                                    'type' => 'password',
                                    'wire' => 'newPassword',
                                    'classes' => '',
                                    'id' => 'new_password',
                                    'attributes' => 'required',
                                ])

                                @include('custom-components.site.validation-error', [
                                    'name' => 'newPassword',
                                ])

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">

                                @include('custom-components.site.label', [
                                   'for' => 'confirm_password',
                                   'content' => 'تکرار رمز',
                                   'classes' => ''
                               ])
                                @include('custom-components.site.required-tag')

                                @include('custom-components.site.input', [
                                    'type' => 'password',
                                    'wire' => 'newPassword_confirmation',
                                    'classes' => '',
                                    'id' => 'confirm_password',
                                    'attributes' => 'required',
                                ])

                                @include('custom-components.site.validation-error', [
                                    'name' => 'confirmPassword',
                                ])

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="submit-btn mt-4 ">
                                <button id="submit" class="rr-primary-btn">تغییر رمز عبور</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </section>

    </div>

</div>

@section('scripts')
@endsection
