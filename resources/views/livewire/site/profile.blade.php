@section('styles')
    <style>
        body {
            direction: rtl;
            background-color: #f8f8f8;
            /*margin: 0;*/
            color: #333;
        }

        .dashboard {
            display: flex;
            margin: 40px auto;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            transition: 0.3s;
        }

        /* ========== Sidebar (Desktop) ========== */
        .sidebar {
            width: 250px;
            background-color: #E53935;
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 20px 10px;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 500;
        }

        .menu-item {
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
        }

        .menu-item:hover,
        .menu-item.active {
            background-color: #c62828;
        }

        /* ========== Main Content ========== */
        .content {
            flex: 1;
            padding: 30px;
        }

        .content section {
            display: none;
            animation: fadeIn 0.3s ease-in-out;
        }

        .content section.active {
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

        h2 {
            color: #E53935;
            border-bottom: 2px solid #E53935;
            padding-bottom: 10px;
            margin-bottom: 25px;
            font-size: 20px;
        }

        .card {
            background: #fafafa;
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        button {
            background-color: #E53935;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            font-size: 15px;
        }

        button:hover {
            background-color: #c62828;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow-x: auto;
            display: block;
        }

        th, td {
            border-bottom: 1px solid #eee;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            min-width: 100px;
        }

        th {
            background-color: #E53935;
            color: #fff;
        }

        /* ========== Responsive Design ========== */
        @media (max-width: 900px) {
            .dashboard {
                flex-direction: column;
                margin: 0;
                border-radius: 0;
            }

            .sidebar {
                flex-direction: row;
                width: 100%;
                justify-content: space-around;
                align-items: center;
                padding: 10px;
            }

            .sidebar h3 {
                display: none;
            }

            .menu-item {
                flex: 1;
                text-align: center;
                font-size: 14px;
                padding: 10px;
            }

            .content {
                padding: 20px;
            }

            .card {
                padding: 15px;
            }

            h2 {
                font-size: 18px;
            }

            input {
                font-size: 13px;
            }

            button {
                width: 100%;
            }
        }

        @media (max-width: 500px) {
            .menu-item {
                font-size: 13px;
                padding: 8px;
            }

            h2 {
                font-size: 16px;
            }

            th, td {
                font-size: 12px;
            }
        }
    </style>
@endsection


<div class="dashboard container">

    <div class="sidebar">
        <h4 class="text-white d-none d-md-block">پروفایل من</h4>
        <button class="menu-item active" onclick="showSection('info')">اطلاعات</button>
        <button class="menu-item" onclick="showSection('payments')">پرداخت‌ها</button>
        <button class="menu-item" onclick="showSection('orders')">سفارشات</button>
        <button class="menu-item" onclick="showSection('password')">رمز عبور</button>
    </div>

    <div class="content">

        <section id="info" class="active">
            <h2>اطلاعات کاربر</h2>
            <div class="row">
                <div class="card col-12 p-3">
                    <div class="row g-3">

                        <div class="col-md-6 col-sm-12">
                            <div class="mb-2"><strong>نام :</strong> {{ $user->name }}</div>
                            <div class="mb-2"><strong>ایمیل:</strong> {{ $user->email }}</div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="mb-2"><strong>شماره تماس:</strong> {{ $user->mobile }}</div>
                            <div class="mb-2"><strong>عضو از تاریخ:</strong> {{ $user->jalali_created_at }}</div>
                        </div>

                    </div>
                </div>
            </div>

        </section>

        <section id="payments">
            <h2> پرداخت‌ها</h2>
            <table>
                <thead>
                <tr>
                    <th>تاریخ</th>
                    <th>مبلغ</th>
                    <th>وضعیت</th>
                    <th>روش پرداخت</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1402/11/10</td>
                    <td>۵۰۰,۰۰۰ تومان</td>
                    <td>موفق</td>
                    <td>کارت بانکی</td>
                </tr>


                </tbody>
            </table>
        </section>

        <section id="orders">
            <h2>سفارشات</h2>
            <table>
                <thead>
                <tr>
                    <th>جمع اقلام ( تومان )</th>
                    <th> تخفیف ( تومان )</th>
                    <th> مالیات ( تومان )</th>
                    <th> هزینه ارسال ( تومان )</th>
                    <th> جمع کل ( تومان )</th>
                    <th> وضعیت</th>
                    <th> توضیحات</th>
                    <th> تاریخ</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ number_format($order->subtotal) }}</td>
                        <td>{{ number_format($order->discount) }}</td>
                        <td>{{ number_format($order->tax) }}</td>
                        <td>{{ number_format($order->shipping_fee) }}</td>
                        <td>{{ number_format($order->total) }}</td>
                        <td>{{ $order->status_label }}</td>
                        <td>{{ $order->description }}</td>
                        <td>{{ $order->jalali_created_at }}</td>
                    </tr>
                @empty
                    @include('custom-components.site.empty-table')
                @endforelse

                </tbody>
            </table>

        </section>

        <section id="password">
            <h2>تغییر رمز عبور</h2>
            <form>
                <label>رمز فعلی</label>
                <input type="password" placeholder="رمز فعلی را وارد کنید">

                <label>رمز جدید</label>
                <input type="password" placeholder="رمز جدید را وارد کنید">

                <label>تأیید رمز جدید</label>
                <input type="password" placeholder="رمز جدید را دوباره وارد کنید">

                <div class="submit-btn mt-5">
                    <button id="submit" class="rr-primary-btn" type="submit">تغییر رمز عبور</button>
                </div>
            </form>
        </section>
    </div>

</div>

@section('scripts')
    <script>
        function showSection(id) {
            document.querySelectorAll('.menu-item').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.content section').forEach(s => s.classList.remove('active'));
            document.querySelector(`.menu-item[onclick="showSection('${id}')"]`).classList.add('active');
            document.getElementById(id).classList.add('active');
        }
    </script>
@endsection
