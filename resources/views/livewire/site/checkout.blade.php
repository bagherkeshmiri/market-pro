<div>
    <section class="checkout-section pt-50 pb-50">
        <div class="container rtl">
            <div class="checkout-top">
                <div class="coupon-list">
                    @guest
                        <div class="verify-item mb-30">
                            <h4 class="title">حساب کاربری دارید؟
                                <a href="{{ route('site.login') }}" style="color: black;">
                                    وارد شوید
                                </a>
                            </h4>
                        </div>

                    @endguest
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="checkout-left">
                        <h3 class="form-header">جزئیات صورتحساب</h3>
                        <form>
                            <div class="checkout-form-wrap">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <label for="email" class="form-title">آدرس ایمیل</label>
                                            @include('custom-components.site.required-tag')
                                            <input type="email" id="email" name="email" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <label for="fullName" class="form-title">نام و نام خانوادگی</label>
                                            @include('custom-components.site.required-tag')
                                            <input type="text" id="fullName" name="fullName" class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <label for="country" class="form-title">کشور</label>
                                            @include('custom-components.site.required-tag')
                                            <div class="nice-select select-control form-control country " tabindex="0">
                                                <span class="current">ایران</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <label for="province" class="form-title">استان</label>
                                            @include('custom-components.site.required-tag')
                                            <div class="nice-select select-control form-control province " tabindex="0">
                                                <span class="current">کرج</span>
                                                <ul class="list">
                                                    <li data-value="" class="option selected focus">تهران</li>
                                                    <li data-value="vdt" class="option">شیراز</li>
                                                    <li data-value="can" class="option">اصفهان</li>
                                                    <li data-value="uk" class="option">قزوین</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <label for="city" class="form-title">شهر</label>
                                            @include('custom-components.site.required-tag')
                                            <div class="nice-select select-control form-control city" tabindex="0">
                                                <span class="current">کرج</span>
                                                <ul class="list">
                                                    <li data-value="" class="option selected focus">تهران</li>
                                                    <li data-value="vdt" class="option">شیراز</li>
                                                    <li data-value="can" class="option">اصفهان</li>
                                                    <li data-value="uk" class="option">قزوین</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <label for="postalCode" class="form-title">کد پستی</label>
                                            @include('custom-components.site.required-tag')
                                            <input type="number" id="postalCode" name="postalCode" class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <label for="postalCode" class="form-title"> تلفن</label>
                                            @include('custom-components.site.required-tag')
                                            <input type="number" id="postalCode" name="postalCode" class="form-control">
                                        </div>
                                    </div>

                                </div>


                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <label for="orderMessage" class="form-title"> یادداشت های سفارش</label>
                                            <textarea id="orderMessage" name="orderMessage" cols="30" rows="5" class="form-control address"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="checkout-right">
                        <h3 class="form-header">سفارش شما</h3>
                        <div class="order-box">
                            <div class="order-items">
                                <div class="order-item item-1">
                                    <div class="order-left">
                                        <span class="product">محصول</span>
                                    </div>
                                    <div class="order-right">
                                        <span class="price">قیمت</span>
                                    </div>
                                </div>


                                @forelse($cart as $key => $value)
                                    <div class="order-item">
                                        <div class="order-left">
                                            <div class="order-img"><img src="{{ asset($value['image']) }}" alt="img"></div>
                                        </div>
                                        <div class="order-right">
                                            <div class="content">
                                                <span class="category">هدفون</span>
                                                <h4 class="title">{{ $value['name'] }}</h4>
                                            </div>
                                            <span class="price" style="color: black;">{{ number_format($value['unit_price']) }}  تومان</span>
                                        </div>
                                    </div>

                                @empty

                                @endforelse

                                <div class="order-item item-1">
                                    <div class="order-left">
                                        <span class="left-title">جمع کل خرید</span>
                                    </div>
                                    <div class="order-right">
                                        <span class="right-title">{{ number_format($cartTotal) }} تومان</span>
                                    </div>
                                </div>
                                <div class="order-item item-1">
                                    <div class="order-left">
                                        <span class="left-title"> تخفیفات </span>
                                    </div>
                                    <div class="order-right">
                                        <span class="right-title ">{{ number_format($discount) }} تومان</span>
                                    </div>
                                </div>
                                <div class="order-item item-1">
                                    <div class="order-left">
                                        <span class="left-title"> هزینه ارسال </span>
                                    </div>
                                    <div class="order-right">

                                        @if($this->totalPayable > $this->freeShipping)
                                            <span class="right-title">رایگان</span>
                                        @else
                                            <span class="right-title">{{ number_format($shipping) }} تومان</span>
                                        @endif

                                    </div>
                                </div>
                                <div class="order-item item-1">
                                    <div class="order-left">
                                        <span class="left-title">مالیات بر ارزش افزوده (9 ٪)</span>
                                    </div>
                                    <div class="order-right">
                                        <span class="right-title ">{{ number_format($tax) }} تومان </span>
                                    </div>
                                </div>
                                <div class="order-item item-1">
                                    <div class="order-left">
                                        <span class="left-title" style="color: black; font-size: var(--rr-fs-h4) !important;">مبلغ قابل پرداخت</span>
                                    </div>
                                    <div class="order-right">
                                        <span class="right-title title-2" style="font-size: var(--rr-fs-h4) !important;">{{ number_format($this->totalPayable) }} تومان</span>
                                    </div>
                                </div>


                            </div>
                            <div class="payment-option-wrap">
                                <button class="rr-primary-btn order-btn"> پرداخت</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
