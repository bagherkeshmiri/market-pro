<div>

    <section class="login-area pt-50 pb-50">
        <div class="container">
            <div class="login-wrap text-center">
                <h3 class="title">حساب کاربری برای خود بسازید</h3>
                <a class="google-login"><img src="{{ asset('images/site/google.png') }}" alt="google">با گوگل وارد شوید</a>
                <span class="or-text">یا</span>
                @include('custom-components.site.flash-message')


                <form wire:submit.prevent="create" class="login-form">
                    <div class="form-item">
                        <div class="d-flex align-items-center gap-1" dir="{{ app()->isLocale('fa') ? 'rtl' : 'ltr' }}">
                            @include('custom-components.site.label', [
                                'for' => 'email',
                                'content' => 'ایمیل',
                                'classes' => ''
                            ])
                            @include('custom-components.site.required-tag')
                        </div>

                        @include('custom-components.site.input', [
                               'type' => 'email',
                               'wire' => 'email',
                               'classes' => '',
                               'id' => 'email',
                               'attributes' => 'required',
                        ])

                        @include('custom-components.site.validation-error', [
                             'name' => 'email',
                        ])

                    </div>

                    <div class="form-item">
                        <div class="d-flex align-items-center gap-1" dir="{{ app()->isLocale('fa') ? 'rtl' : 'ltr' }}">
                            @include('custom-components.site.label', [
                                'for' => 'password',
                                'content' => 'رمز عبور',
                                'classes' => ''
                            ])
                            @include('custom-components.site.required-tag')
                        </div>

                        @include('custom-components.site.input', [
                               'type' => 'password',
                               'wire' => 'password',
                               'classes' => '',
                               'id' => 'password',
                               'attributes' => 'required',
                        ])

                        @include('custom-components.site.validation-error', [
                             'name' => 'password',
                        ])

                    </div>

                    <div class="form-item">
                        <div class="checkbox-wrap mb-10">
                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                            <label for="vehicle1"> مشترک شوید تا از محصولات و پیشنهادات جدید مطلع شوید</label><br>
                        </div>
                        <div class="checkbox-wrap">
                            <input type="checkbox" id="vehicle2" name="vehicle2" value="Bike">
                            <label for="vehicle2"> من قبول میکنم  <span>شرایط / سیاست حفظ حریم خصوصی</span></label><br>
                        </div>
                    </div>
                    <div class="submit-btn">
                        <button type="submit"  class="rr-primary-btn">ثبت حساب</button>
                    </div>
                    <div class="login-btn-wrap">
                        <span class="forgot">حساب کاربری دارید؟</span>
                        <a class="log-in" href="{{ route('site.login') }}">وارد شدن</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

</div>
