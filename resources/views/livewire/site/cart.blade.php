@section('body-class', 'cart-page')

<div>
    <section class="cart-section pt-130 pb-130">
        <div class="container rtl">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-top-content">
                        <p>فقط کافیه <span>59 تومان</span> به سبد خرید اضافه کنید تا ارسال رایگان شود</p>
                        <div class="line"></div>
                    </div>
                    <div class="table-content cart-table">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th class="product-remove"></th>
                                <th class="cart-product-name text-center">محصول</th>
                                <th class="product-price text-center"> قیمت واحد</th>
                                <th class="product-quantity text-center">تعداد</th>
                                <th class="product-subtotal text-center">قیمت کل</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($cart as $item)
                                <tr id="cart-item-{{ $item['id'] }}">
                                    <td class="product-remove">
                                        <button wire:click="removeFromCart({{ $item['product_id'] }})">
                                            <i class="fa-sharp fa-regular fa-trash" style="color:#FF5B5C !important;"></i>
                                        </button>
                                    </td>
                                    <td class="product-thumbnail">
                                        <a href="#">
                                            <img src="{{ asset($item['image']) }}" alt="img">
                                        </a>
                                        <div class="product-thumbnail">
                                            <h4 class="title">{{ $item['name'] }}</h4>
                                        </div>
                                    </td>
                                    <td class="product-price "><span class="amount">{{ number_format($item['price']) }}  تومان</span></td>
                                    <td class="product-quantity">
                                        <div class="quantity__group">
                                            <label for="quantity-item-{{ $item['id'] }}" hidden></label>
                                            <input type="number" class="input-text qty text" id="quantity-item-{{ $item['id'] }}" name="quantity" value="1" min="1" max="100" step="1" autocomplete="off">
                                        </div>
                                    </td>
                                    <td class="product-subtotal" id="product-subtotal-{{ $item['id'] }}"><span class="amount">0</span></td>
                                </tr>
                            @endforeach



                            </tbody>
                        </table>
                    </div>
                    <div class="cart-btn-wrap">
                        <div class="left-item">
                            <label for="discount-code" hidden></label>
                            <input type="text" id="discount-code" class="form-control" placeholder="کد را وارد کنید">
                            <button class="rr-primary-btn">تایید کد تخفیف</button>
                        </div>
                        <button class="rr-primary-btn update-btn">بروزرسانی سبد خرید</button>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout-wrapper">
                        <div class="checkout-top checkout-item item-1">
                            <h4 class="title">کل سبد خرید</h4>
                        </div>


                        <div style="border-bottom: 1px solid var(--rr-color-border-1);">
                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="cart-title">
                                    جمع سبد خرید
                                </h4>
                                <span class="cart-price" >1,000,000 تومان</span>
                            </div>

                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="cart-title">
                                    تخفیفات
                                </h4>
                                <span class="cart-price">200,000 تومان</span>
                            </div>

                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="cart-title">
                                    هزینه ارسال
                                </h4>
                                <span class="cart-price">10,000 تومان</span>
                            </div>

                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="cart-title">
                                    مالیات
                                </h4>
                                <span class="cart-price">105,000 تومان</span>
                            </div>

                        </div>
                        <div class="checkout-total checkout-item pt-4">
                            <h4 style="color:#E53E3E !important;">مبلغ قابل پرداخت</h4>
                            <h4>724,000 تومان</h4>
                        </div>

                    </div>


                    <div class="checkout-proceed">
                        <a href="#" class="rr-primary-btn checkout-btn">به تسویه حساب بروید</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@section('scripts')
@endsection


