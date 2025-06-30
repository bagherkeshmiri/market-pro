<div>

    <section class="login-area pt-100 pb-100">
        <div class="container">
            <div class="login-wrap text-center">
                <h3 class="title">حساب کاربری برای خود بسازید</h3>
                <a href="#" class="google-login"><img src="{{ asset('images/site/google.png') }}" alt="google">با گوگل وارد شوید</a>
                <span class="or-text">یا</span>
                <form action="#" class="login-form">
                    <div class="form-item">
                        <label for="email" class="form-header text-dark">*  ایمیل</label>
                        <input type="email" id="email" name="email" class="form-control" >
                    </div>
                    <div class="form-item">
                        <label for="password" class="form-header text-dark">* کلمه عبور</label>
                        <input type="text" id="password" name="password" class="form-control" >
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
                        <button class="rr-primary-btn">ثبت حساب</button>
                    </div>
                    <div class="login-btn-wrap">
                        <a href="#" class="forgot">حساب کاربری دارید؟</a>
                        <a class="log-in" href="{{ route('site.login') }}">وارد شدن</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

</div>
