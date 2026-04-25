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

        /* !important : dont remove */
        .no-wrap-text {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            direction: rtl;
        }

    </style>

@endsection


<div>
    <section class="checkout-section pb-50">
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

                                @if(!$this->userAddresses->isEmpty())
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="form-item">
                                                <label for="savedAddress" class="form-title">آدرس‌ های من</label>
                                                <select id="savedAddress" class="form-control"
                                                        wire:model.defer="selectedAddressId"
                                                        wire:change="fillAddressFromSaved">
                                                    @if(empty($selectedAddressId))
                                                        <option value="">انتخاب آدرس</option>
                                                    @endif
                                                    @foreach($userAddresses as $userAddress)
                                                        <option
                                                            value="{{ $userAddress->id }}">{{ $userAddress->full_address }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">

                                            @include('custom-components.site.label', [
                                                'for' => 'email',
                                                'content' => 'ایمیل',
                                                'classes' => 'form-title'
                                            ])

                                            @include('custom-components.site.required-tag')

                                            @include('custom-components.site.input', [
                                                'type' => 'email',
                                                'wire' => 'email',
                                                'classes' => '',
                                                'id' => 'email',
                                                'attributes' => 'required',
                                            ])

                                            @include('frest-components.validation-error',[ 'name' => 'email' ])
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-item">

                                            @include('custom-components.site.label', [
                                                'for' => 'fullName',
                                                'content' => 'نام و نام خانوادگی',
                                                'classes' => 'form-title'
                                            ])

                                            @include('custom-components.site.required-tag')

                                            @include('custom-components.site.input', [
                                                'type' => 'text',
                                                'wire' => 'fullName',
                                                'classes' => '',
                                                'id' => 'fullName',
                                                'attributes' => 'required',
                                            ])

                                            @include('frest-components.validation-error',[ 'name' => 'fullName' ])
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-item">

                                            @include('custom-components.site.label', [
                                                'for' => 'country',
                                                'content' => 'کشور',
                                                'classes' => 'form-title'
                                            ])

                                            @include('custom-components.site.required-tag')
                                            <select id="country" class="form-control">
                                                <option value="iran">ایران</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">

                                        <div class="form-item">

                                            @include('custom-components.site.label', [
                                               'for' => 'province',
                                               'content' => 'استان',
                                               'classes' => 'form-title'
                                           ])

                                            @include('custom-components.site.required-tag')
                                            <select id="province" class="form-control"
                                                    wire:model.defer="selectedProvince"
                                                    wire:change="provinceSelected($event.target.value)">
                                                @if(empty($selectedProvince) && empty($selectedAddressId))
                                                    <option>انتخاب کنید</option>
                                                @endif
                                                @foreach($provinces as $id => $name)
                                                    <option value="{{ $id }}">
                                                        {{ $name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @include('frest-components.validation-error',[ 'name' => 'selectedProvince' ])
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-item">

                                            @include('custom-components.site.label', [
                                              'for' => 'city',
                                              'content' => 'شهر',
                                              'classes' => 'form-title'
                                            ])

                                            @include('custom-components.site.required-tag')
                                            <select id="city" class="form-control"
                                                    wire:model="selectedCity"
                                                    wire:key="city-select-{{ $selectedProvince }}"
                                            >
                                                @if($cities && count($cities) > 0)
                                                    @foreach($cities as $id => $name)
                                                        <option value="{{ (int) $id }}">{{ $name }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">ابتدا استان انتخاب شود</option>
                                                @endif
                                            </select>
                                            @include('frest-components.validation-error',[ 'name' => 'selectedCity' ])
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">

                                            @include('custom-components.site.label', [
                                                'for' => 'address',
                                                'content' => ' آدرس پستی',
                                                'classes' => 'form-title'
                                            ])

                                            @include('custom-components.site.required-tag')

                                            @include('custom-components.site.input', [
                                                'type' => 'text',
                                                'wire' => 'address',
                                                'classes' => '',
                                                'id' => 'address',
                                                'attributes' => 'required',
                                            ])

                                            @include('frest-components.validation-error',[ 'name' => 'address' ])
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-item">

                                            @include('custom-components.site.label', [
                                                'for' => 'postalCode',
                                                'content' => 'کد پستی',
                                                'classes' => 'form-title'
                                            ])

                                            @include('custom-components.site.required-tag')

                                            @include('custom-components.site.input', [
                                                'type' => 'number',
                                                'wire' => 'postalCode',
                                                'classes' => '',
                                                'id' => 'postalCode',
                                                'attributes' => 'required',
                                            ])

                                            @include('frest-components.validation-error',[ 'name' => 'postalCode' ])
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">

                                            @include('custom-components.site.label', [
                                                'for' => 'orderMessage',
                                                'content' => 'یادداشت های سفارش',
                                                'classes' => 'form-title'
                                            ])

                                            @include('custom-components.site.textarea', [
                                                'type' => 'text',
                                                'wire' => 'orderMessage',
                                                'classes' => 'address',
                                                'id' => 'orderMessage',
                                                'attributes' => 'required',
                                            ])

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

                                @foreach($cart as $key => $value)
                                    <div class="order-item">
                                        <div class="order-left">
                                            <div class="order-img"><img src="{{ asset($value['image']) }}" alt="img">
                                            </div>
                                        </div>
                                        <div class="order-right">
                                            <div class="content">
                                                <h4 class="title">{{ $value['name'] }}</h4>
                                            </div>
                                            <span class="price" style="color: black;">{{ number_format($value['unit_price']) }}  تومان</span>
                                        </div>
                                    </div>

                                @endforeach

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
                                    <span wire:loading.remove wire:target="pay">پرداخت</span>
                                    <span wire:loading wire:target="pay">  در حال انتقال به درگاه پرداخت </span>
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
        window.addEventListener('error', event => {
            Swal.fire({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                width: '650px',
                timer: 10000,
                background: '#E53E3E',
                color: '#FFF',
                title: `${event.detail.content}`,
                customClass: {
                    title: 'swal2-title-rtl no-wrap-text'
                },
                timerProgressBar: true,

            });
        });

    </script>
@endsection


