<div>
    <section class="cart-section pt-50 pb-50">
        <div class="container rtl">
            <div class="row">
                <div class="col-lg-8">
                    @if($this->totalPayable < $this->freeShipping)
                        <div class="cart-top-content">
                            <p>فقط کافیه <span>{{ number_format($remainingFreeShipping) }} تومان</span> به سبد خرید اضافه کنید تا ارسال رایگان شود</p>
                            <div class="line" style="--line-width: {{ $usedFreeShippingLineProgress }}%;"></div>
                        </div>
                    @endif

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


                            @forelse($cart as $key => $value)
                                <tr id="cart-item-{{ $key }}">
                                    <td class="product-remove">
                                        <button wire:click="removeProductFromCart({{ $key }})">
                                            <i class="fa-sharp fa-regular fa-trash" style="color:#FF5B5C !important;"></i>
                                        </button>
                                    </td>
                                    <td class="product-thumbnail">
                                        <a href="{{ route('site.single-product',['product' => $key]) }}">
                                            <img src="{{ asset($value['image']) }}" alt="img">
                                        </a>
                                        <div class="product-thumbnail">
                                            <a href="{{ route('site.single-product',['product' => $key]) }}">
                                                <h4 class="title">{{ $value['name'] }}</h4>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="product-price "><span class="amount">{{ number_format($value['unit_price']) }}  تومان</span></td>
                                    <td class="product-quantity">
                                        <div class="quantity__group">
                                            <label for="qty" hidden></label>
                                            <input type="number"
                                                   id="qty"
                                                   min="1"
                                                   max="100"
                                                   step="1"
                                                   wire:model.lazy="cart.{{ $key }}.qty"
                                                   class="input-text qty text"/>
                                        </div>
                                    </td>
                                    <td class="product-subtotal"><span class="amount"> {{ number_format($value['final_price']) }} تومان </span></td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" style="text-align:center;">سبد خرید شما خالی است</td>
                                </tr>
                            @endforelse


                            </tbody>
                        </table>

                    </div>

                    <div class="cart-btn-wrap">


                        @if(!empty($cart))
                            <div class="left-item">
                                <label for="discount-code" hidden></label>
                                <input type="text" wire:model.lazy="discountCode" id="discount-code" class="form-control" placeholder="کد تخفیف را وارد کنید">
                                <button class="rr-primary-btn" wire:click="checkDiscountCode()">تایید کد تخفیف</button>
                            </div>
                        @endif


                        @if (!is_null(session('warning')))
                            <span class="alert alert-warning" role="alert" style="margin-bottom: 0;">
                                {{ session('warning') }}
                            </span>
                        @endif


                        @if (!is_null(session('success')))
                            <span class="alert alert-success" role="alert" style="margin-bottom: 0;">
                                {{ session('success') }}
                            </span>
                        @endif

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
                                <span class="cart-price">{{ number_format($cartTotal) }} تومان</span>
                            </div>

                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="cart-title">
                                    تخفیفات
                                </h4>
                                <span class="cart-price">{{ number_format($discount) }} تومان</span>
                            </div>

                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="cart-title">
                                    هزینه ارسال
                                </h4>
                                @if($this->totalPayable > $this->freeShipping)
                                    <span class="cart-price">رایگان</span>
                                @else
                                    <span class="cart-price">{{ number_format($shipping) }} تومان</span>
                                @endif
                            </div>

                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="cart-title">
                                    مالیات بر ارزش افزوده (9 ٪)
                                </h4>
                                <span class="cart-price">{{ number_format($tax) }} تومان</span>
                            </div>

                        </div>
                        <div class="checkout-total checkout-item pt-4">
                            <h4 style="color:#E53E3E !important;">مبلغ قابل پرداخت</h4>
                            <h4>{{ number_format($this->totalPayable) }} تومان </h4>
                        </div>

                    </div>


                    @if(!empty($cart))
                        <div class="checkout-proceed">
                            <a href="{{ route('site.checkout') }}" class="rr-primary-btn checkout-btn">تایید و تکمیل سفارش</a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
</div>

@section('scripts')
@endsection



