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
                            <tr>
                                <td class="product-remove">
                                    <button>
                                        <i class="fa-sharp fa-regular fa-trash" style="color:#FF5B5C !important;"></i>
                                    </button>
                                </td>

                                <td class="product-thumbnail">
                                    <a href="#">
                                        <img src="{{ asset('images/site/cart-img-1.png') }}" alt="img">
                                    </a>
                                    <div class="product-thumbnail">
                                        <h4 class="title">کفش مجلسی مدل لارا</h4>
                                    </div>
                                </td>
                                <td class="product-price "><span class="amount">555,000 تومان</span></td>
                                <td class="product-quantity">
                                    <div class="quantity__group">
                                        <input type="number" class="input-text qty text" name="quantity" value="1" min="1" max="100" step="1" autocomplete="off">
                                    </div>
                                </td>
                                <td class="product-subtotal"><span class="amount">989,000  تومان</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-btn-wrap">
                        <div class="left-item">
                            <input type="text" class="form-control" placeholder="کد را وارد کنید">
                            <button class="rr-primary-btn">تایید کد تخفیف</button>
                        </div>
                        <button class="rr-primary-btn update-btn">به روزرسانی سبد خرید</button>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout-wrapper">
                        <div class="checkout-top checkout-item item-1">
                            <h4 class="title">کل سبد خرید</h4>
                        </div>
                        <div class="checkout-top checkout-item">

                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <h4 class="title">جمع کل</h4>
                                <span class="price">1,459,000 تومان</span>
                            </div>


                        </div>

                        <div class="checkout-shipping checkout-item">
                            <h4 class="title">ارسال</h4>
                            <div class="shipping-right">
                                <div class="checkout-option-wrapper">
                                    <div class="shipping-option">
                                        <input id="flat_rate" type="radio" name="shipping">
                                        <label for="flat_rate">ارسال رایگان</label>
                                    </div>
                                    <div class="shipping-option">
                                        <input id="local_pickup" type="radio" name="shipping">
                                        <label for="local_pickup">نرخ ثابت</label>
                                    </div>
                                    <div class="shipping-option">
                                        <input id="free_shipping" type="radio" name="shipping">
                                        <label for="free_shipping">وانت محلی</label>
                                    </div>
                                </div>
                                <p>گزینه های حمل و نقل به روز می شود <br> در هنگام تسویه حساب</p>
                                <span>محاسبه حمل و نقل</span>
                            </div>
                        </div>
                        <div class="checkout-total checkout-item">
                            <h4 class="title">جمع</h4>
                            <span>724 هزا تومان</span>
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
