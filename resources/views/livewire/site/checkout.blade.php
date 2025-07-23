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
                                            <input type="email" id="email" name="email" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-item name">
                                            <h4 class="form-title">نام *</h4>
                                            <input type="text" id="fullname-2" name="fullname-2" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <h4 class="form-title">نام خانوادگی *</h4>
                                            <input type="text" id="lastname" name="lastname" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-title">نام شرکت (اختیاری)*</h4>
                                            <input type="text" id="company" name="company" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-title">کشور / منطقه*</h4>
                                            <input type="text" id="country" name="country" class="form-control" placeholder="ایالات متحده (ایالات متحده)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item ">
                                            <h4 class="form-title">آدرس خیابان*</h4>
                                            <input type="text" id="street" name="street" class="form-control street-control" placeholder="شماره خانه و شماره خیابان">
                                            <input type="text" id="street-2" name="street-2" class="form-control street-control-2" placeholder="آپارتمان، سوئیت، واحد و غیره (اختیاری)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-title">استان*</h4>
                                            <input type="text" id="town" name="town" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-title">شهر</h4>
                                            <div class="nice-select select-control form-control country open" tabindex="0"><span class="current">کرج</span>
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
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-title">کد پستی*</h4>
                                            <input type="text" id="zip" name="zip" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-title">تلفن*</h4>
                                            <input type="text" id="phone" name="phone" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-title">یادداشت های سفارش *</h4>
                                            <textarea id="message" name="message" cols="30" rows="5" class="form-control address"></textarea>
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
