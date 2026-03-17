<div>
    <section class="login-area pt-50 pb-50">
        <div class="container">
            <div class="login-wrap text-center">
                <h3 class="title">وارد حساب کاربری خود شوید</h3>
                <a class="google-login"><img src="{{ asset('images/site/google.png') }}" alt="google">با گوگل وارد شوید</a>
                <span class="or-text">یا</span>

                @include('custom-components.site.flash-message')

                <form wire:submit.prevent="login" class="login-form">
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
                        <div class="checkbox-wrap">
                            <input type="checkbox" id="remember_me" wire:model="remember">
                            <label class="text-dark" for="remember_me">مرا به خاطر بسپار</label><br>
                        </div>
                    </div>

                    <div class="submit-btn">
                        <button type="submit" class="rr-primary-btn">ورود به حساب کاربری</button>
                    </div>

                    <a class="forgot">رمز عبور خود را گم کرده‌اید؟</a>
                    <div class="login-btn-wrap">
                        <span class="forgot">حساب کاربری ندارید؟</span>
                        <a class="log-in" href="{{ route('site.register') }}">عضو شوید</a>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>
