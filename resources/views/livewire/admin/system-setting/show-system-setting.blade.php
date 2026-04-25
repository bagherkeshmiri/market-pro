@section('styles')
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

                                    <form class="form" wire:submit.prevent="update">
                                        <div class="form-body">
                                            <div class="row">

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'label' , 'content' => 'عنوان'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.input',[ 'type' => 'text' , 'wire' => 'label' , 'classes' => 'text-left' , 'id' => 'label' , 'icon' => titleIcon() , 'attributes' => 'required' ])
                                                        @include('frest-components.validation-error',[ 'name' => 'label' ])
                                                    </div>
                                                </div>


                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'key' , 'content' => 'کلید'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.input',[ 'type' => 'text' , 'wire' => 'key' , 'classes' => 'text-left' , 'id' => 'key' , 'icon' => titleIcon() , 'attributes' => 'required' ])
                                                        @include('frest-components.validation-error',[ 'name' => 'key' ])
                                                    </div>
                                                </div>


                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'type' , 'content' => 'نوع داده'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.simple-selectbox',[ 'data' => $types , 'id' => 'type' , 'wire' => 'type'  ,'isDefer' => true])
                                                        @include('frest-components.validation-error',[ 'name' => 'type' ])
                                                    </div>
                                                </div>


                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'value' , 'content' => 'مقدار'] )
                                                        @include('frest-components.required-tag')

                                                        @if($type != \App\Enums\SystemSettingType::Json || $type != \App\Enums\SystemSettingType::Array)
                                                            @include('frest-components.input',[ 'type' => 'text' , 'wire' => 'value' , 'classes' => 'text-left' , 'id' => 'value' , 'icon' => titleIcon() , 'attributes' => 'required' ])
                                                        @else
                                                            @include('frest-components.textarea',[ 'type' => 'text' , 'wire' => 'value' , 'classes' => 'text-left' , 'id' => 'value' , 'icon' => titleIcon() , 'attributes' => 'required' ])
                                                        @endif

                                                        @include('frest-components.validation-error',[ 'name' => 'value' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-end mt-2">
                                                    @include('frest-components.submit-button', [ 'classes' => 'btn btn-primary mr-1 mb-1' , 'id' => 'save_btn' , 'content' => __('global.save')  , 'icon' => saveIcon() ])
                                                    @include('frest-components.link-button',[ 'href' => route('admin.system-setting.index') , 'classes' => 'btn btn-danger mr-1 mb-1' , 'id' => 'cancel' , 'content' => __('global.cancel')  , 'icon' => arrowIcon() ])
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

    @php
        $amountDiscountType = \App\Enums\DiscountType::Amount->value;
    @endphp

    <script>

        let jsAmountDiscountType = @json($amountDiscountType);
        let typeInput = document.getElementById('type');
        let amountInput = document.getElementById('amount');
        let minOrderAmountInput = document.getElementById('minOrderAmount');

        $(function () {
            const $datepicker = $('.shamsi-datepicker');

            $datepicker.datepicker({
                format: "yyyy/mm/dd",
                autoclose: true,
                todayHighlight: true,
                language: "fa"
            });

            $datepicker.on("change", function () {
                @this.
                set('expiresAt', $(this).val());
            });
        });

        function formatPrice(input) {
            if (input.type !== 'text' && input.tagName.toLowerCase() !== 'textarea') {
                return;
            }
            let cursorPosition = input.selectionStart;
            let value = input.value.replace(/[^0-9]/g, '').replace(/^0+/, '');
            let formatted = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            let diff = formatted.length - input.value.length;
            input.value = formatted;
            if (typeof input.setSelectionRange === 'function') {
                input.setSelectionRange(cursorPosition + diff, cursorPosition + diff);
            }
        }

        window.addEventListener('DOMContentLoaded', function () {

            if (amountInput) {

                formatPrice(amountInput);
                formatPrice(minOrderAmountInput);


                amountInput.addEventListener('input', function () {
                    const Type = Number(document.getElementById('type').value);
                    if (Type === jsAmountDiscountType) {
                        formatPrice(amountInput);
                    }
                });
            }


            if (minOrderAmountInput) {
                minOrderAmountInput.addEventListener('input', function () {
                    formatPrice(minOrderAmountInput);
                });
            }

        });

        document.getElementById('type').addEventListener('change', function () {
            let Type = Number(this.value);

            if (Type === jsAmountDiscountType) {
                if (amountInput.type === 'number') {
                    amountInput.type = 'text';
                    amountInput.value = 0;
                }
            } else {
                if (amountInput.type === 'text') {
                    amountInput.type = 'number';
                    amountInput.value = 0;
                }
            }

            amountInput.value = 0;

        });


    </script>

@endsection
