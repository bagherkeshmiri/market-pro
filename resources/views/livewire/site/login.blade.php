<div>
    <section class="login-area pt-50 pb-50">
        <div class="container">
            <div class="login-wrap text-center">
                <h3 class="title">وارد حساب کاربری خود شوید</h3>
                <a href="#" class="google-login"><img src="{{ asset('images/site/google.png') }}" alt="google">با گوگل وارد شوید</a>
                <span class="or-text">یا</span>

                @include('custom-components.site.flash-message')


                <form wire:submit.prevent="login" class="login-form">
                    <div class="form-item">
                        <label for="email" class="form-header text-dark">* ایمیل</label>
                        <input type="email" id="email" wire:model.defer="email" class="form-control">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-item">
                        <label for="password" class="form-header text-dark">* کلمه عبور</label>
                        <input type="password" id="password" wire:model.defer="password" class="form-control">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
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

                    <a href="#" class="forgot">رمز عبور خود را گم کرده‌اید؟</a>
                </form>

            </div>
        </div>
    </section>

</div>
