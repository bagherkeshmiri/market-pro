@section('styles')

    <link rel="stylesheet" href="{{ asset('css/frest/vendors/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frest/vendors/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet"
          href="{{ asset('css/frest/vendors/pickers/datepicker-jalali/bootstrap-datepicker.min.css') }}">

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

                                    @include('frest-components.flash-message')

                                    <form class="form" wire:submit.prevent="store">
                                        <div class="form-body">
                                            <div class="row">

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'code' , 'content' => 'کد '] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.input',[ 'type' => 'text' , 'code' => 'name' , 'classes' => 'text-left' , 'id' => 'code' , 'icon' => titleIcon() , 'attributes' => 'required' ])
                                                        @include('frest-components.validation-error',[ 'name' => 'code' ])
                                                    </div>
                                                </div>


                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'type' , 'content' => 'نوع تخفیف'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.simple-selectbox',[ 'data' => $types , 'id' => 'type' , 'wire' => 'type'  ,'isDefer' => true])
                                                        @include('frest-components.validation-error',[ 'name' => 'type' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'isActive' , 'content' => 'وضعیت'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.simple-selectbox',[ 'data' => $statuses , 'id' => 'isActive' , 'wire' => 'isActive'  ,'isDefer' => true])
                                                        @include('frest-components.validation-error',[ 'name' => 'isActive' ])
                                                    </div>
                                                </div>


                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'amount' , 'content' => 'مقدار تخفیف'] )
                                                        @include('frest-components.required-tag')
                                                        <span class="text-warning pl-1" style="font-size: 0.7rem;">   درصد یا تومان   </span>
                                                        @include('frest-components.input',[ 'type' => 'text' , 'amount' => 'name' , 'classes' => 'text-left' , 'id' => 'amount' , 'icon' => dollarIcon() , 'attributes' => 'required' ])
                                                        @include('frest-components.validation-error',[ 'name' => 'amount' ])
                                                    </div>
                                                </div>


                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'usageLimit' , 'content' => 'حداکثر دفعات استفاده'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.input',[ 'type' => 'text' , 'usageLimit' => 'name' , 'classes' => 'text-left' , 'id' => 'usageLimit' , 'icon' => plusIcon() , 'attributes' => 'required' ])
                                                        @include('frest-components.validation-error',[ 'name' => 'usageLimit' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'minOrderAmount' , 'content' => 'حداقل سبد خرید'] )
                                                        @include('frest-components.required-tag')
                                                        <span class="text-warning pl-1" style="font-size: 0.7rem;"> تومان </span>
                                                        @include('frest-components.input',[ 'type' => 'text' , 'minOrderAmount' => 'name' , 'classes' => 'text-left' , 'id' => 'minOrderAmount' , 'icon' => dollarIcon() , 'attributes' => 'required' ])
                                                        @include('frest-components.validation-error',[ 'name' => 'minOrderAmount' ])
                                                    </div>
                                                </div>


                                                <div class="col-md-3">
                                                    <div class="mb-1">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'expiresAt' , 'content' => 'تاریخ انقضا'] )
                                                        @include('frest-components.required-tag')
                                                        <fieldset class="form-group position-relative has-icon-left">
                                                            <input type="text" wire:model="expiresAt"
                                                                   class="form-control shamsi-datepicker"
                                                                   placeholder="انتخاب تاریخ">
                                                            <div class="form-control-position">
                                                                <i class="bx bx-calendar"></i>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>


                                                <div class="col-12 d-flex justify-content-end mt-2">
                                                    @include('frest-components.submit-button', [ 'classes' => 'btn btn-primary mr-1 mb-1' , 'id' => 'save_btn' , 'content' => __('global.save')  , 'icon' => saveIcon() ])
                                                    @include('frest-components.link-button',[ 'href' => route('admin.discount.index') , 'classes' => 'btn btn-danger mr-1 mb-1' , 'id' => 'cancel' , 'content' => __('global.cancel')  , 'icon' => arrowIcon() ])
                                                </div>
                                            </div>
                                        </div>
                                    </form>

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
    <script src="{{ asset('js/frest/vendors/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('js/frest/vendors/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('js/frest/vendors/pickers/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('js/frest/vendors/pickers/pickadate/legacy.js') }}"></script>
    <script src="{{ asset('js/frest/vendors/pickers/daterange/moment.min.js') }}"></script>
    <script src="{{ asset('js/frest/vendors/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/frest/vendors/pickers/datepicker-jalali/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/frest/vendors/pickers/datepicker-jalali/bootstrap-datepicker.fa.min.js') }}"></script>
    <script src="{{ asset('js/frest/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>

@endsection
