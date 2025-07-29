@section('styles')
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
            appearance: textfield;
        }
    </style>

@endsection


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
                        <form wire:submit.prevent>
                            <div class="checkout-form-wrap">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <label for="email" class="form-title">آدرس ایمیل</label>
                                            @include('custom-components.site.required-tag')
                                            <input type="email" wire:model.defer="email" id="email"
                                                   class="form-control" required>
                                            @include('frest-components.validation-error',[ 'name' => 'email' ])
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <label for="fullName" class="form-title">نام و نام خانوادگی</label>
                                            @include('custom-components.site.required-tag')
                                            <input type="text" id="fullName" wire:model.defer="fullName"
                                                   class="form-control" required>
                                            @include('frest-components.validation-error',[ 'name' => 'fullName' ])
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
                                            <div class="nice-select select-control form-control province" tabindex="0" wire:ignore>
                                                <span class="current">{{ $selectedProvinceName ?? 'انتخاب استان' }}</span>
                                                <ul class="list">
                                                    @foreach($provinces as $id => $name)
                                                        <li data-value="{{ $id }}" class="option {{ ($selectedProvince == $id) ? 'selected focus' : '' }}"
                                                            onclick="window.Livewire.emit('provinceSelected', {{ $id }}, '{{ $name }}')">
                                                            {{ $name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <label for="city" class="form-title">شهر</label>
                                            @include('custom-components.site.required-tag')
                                            <div class="nice-select select-control form-control city" tabindex="0" wire:ignore>
                                                <span class="current">{{ $selectedCityName ?? 'انتخاب شهر' }}</span>
                                                <ul class="list">
                                                    @foreach($cities as $id => $name)
                                                        <li data-value="{{ $id }}" class="option {{ ($selectedCity == $id) ? 'selected focus' : '' }}"
                                                            onclick="Livewire.emit('citySelected', {{ $id }}, '{{ $name }}')">
                                                            {{ $name }}
                                                        </li>
                                                    @endforeach
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
                                            <input type="number" id="postalCode" wire:model.defer="postalCode"
                                                   class="form-control" required>
                                            @include('frest-components.validation-error',[ 'name' => 'postalCode' ])
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <label for="phone" class="form-title"> تلفن</label>
                                            @include('custom-components.site.required-tag')
                                            <input type="number" id="phone" wire:model.defer="phone" name="phone"
                                                   class="form-control" required>
                                            @include('frest-components.validation-error',[ 'name' => 'phone' ])
                                        </div>
                                    </div>

                                </div>


                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <label for="orderMessage" class="form-title"> یادداشت های سفارش</label>
                                            <textarea id="orderMessage" wire:model.defer="orderMessage"
                                                      cols="30" rows="5"
                                                      class="form-control address">
                                            </textarea>
                                            @include('frest-components.validation-error',[ 'name' => 'orderMessage' ])

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
                                            <div class="order-img"><img src="{{ asset($value['image']) }}" alt="img">
                                            </div>
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
                                        <span class="left-title"
                                              style="color: black; font-size: var(--rr-fs-h4) !important;">مبلغ قابل پرداخت</span>
                                    </div>
                                    <div class="order-right">
                                        <span class="right-title title-2"
                                              style="font-size: var(--rr-fs-h4) !important;">{{ number_format($this->totalPayable) }} تومان</span>
                                    </div>
                                </div>


                            </div>
                            <div class="payment-option-wrap">
                                <button wire:click="pay" wire:loading.attr="disabled" class="rr-primary-btn order-btn">
                                    <span wire:loading.remove>پرداخت</span>
                                    <span wire:loading>  در حال انتقال به درگاه پرداخت </span>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>




@section('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function updateSelectVisual(selectClass) {
                document.querySelectorAll(`.${selectClass} .list .option`).forEach(option => {
                    option.addEventListener('click', function () {
                        const list = this.parentNode;
                        list.querySelectorAll('.option').forEach(li => li.classList.remove('selected', 'focus'));
                        this.classList.add('selected', 'focus');

                        const currentSpan = this.closest(`.${selectClass}`).querySelector('.current');
                        currentSpan.textContent = this.textContent.trim();
                    });
                });
            }

            updateSelectVisual('province');
            updateSelectVisual('city');
        });
    </script>

@endsection


