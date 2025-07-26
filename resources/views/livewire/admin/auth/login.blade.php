
@section('styles')
@endsection


<div class="col-md-6 col-12 px-0">
    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
        <div class="card-header pb-1">
            <div class="card-title">
                <h4 class="text-center mb-2"> ورود مدیران </h4>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="d-flex flex-md-row flex-column justify-content-around">
                    <a href="#" class="btn btn-social btn-google btn-block font-small-3 mr-md-1 mb-md-0 mb-1">
                        <i class="bx bxl-google font-medium-3"></i><span
                            class="pl-50 d-block text-center">@lang('global.google')</span></a>
                    <a href="#" class="btn btn-social btn-block mt-0 btn-facebook font-small-3">
                        <i class="bx bxl-facebook-square font-medium-3"></i><span
                            class="pl-50 d-block text-center">@lang('global.facebook')</span></a>
                </div>
                <div class="divider">
                    <div class="divider-text text-uppercase text-muted"><small> @lang('login.login_with_email') </small>
                    </div>
                </div>


                @include('frest-components.flash-message')


                <form wire:submit.prevent="login">

                    <div class="form-group mb-50">
                        @include('frest-components.label', [
                            'classes' => 'text-bold-700',
                            'for' => 'email',
                            'content' => __('login.email'),
                        ])
                        @include('frest-components.required-tag')
                        @include('frest-components.input', [
                            'type' => 'text',
                            'wire' => 'email',
                            'classes' => 'text-left',
                            'id' => 'email',
                            'icon' => emailIcon(),
                            'attributes' => 'required',
                        ])
                        @include('frest-components.validation-error', ['name' => 'email'])
                    </div>

                    <div class="form-group">
                        @include('frest-components.label', [
                            'classes' => 'text-bold-700',
                            'for' => 'password',
                            'content' => __('login.password'),
                        ])
                        @include('frest-components.required-tag')
                        @include('frest-components.input', [
                            'type' => 'password',
                            'wire' => 'password',
                            'classes' => 'text-left',
                            'id' => 'password',
                            'icon' => lockIcon(),
                            'attributes' => 'required',
                        ])
                        @include('frest-components.validation-error', ['name' => 'password'])
                    </div>

                    <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                        <div class="text-left">
                            @include('frest-components.sm-checkbox', [
                                'checkboxClass' => 'checkbox-success',
                                'id' => 'remember',
                                'for' => 'remember',
                                'label_content' => __('login.remember_me'),
                                'name' => 'remember',
                                'value' => '',
                            ])
                        </div>
                        <div class="text-right line-height-2"><a href="#" class="card-link"><small
                                    class="text-warning"> @lang('login.forget_password') </small></a></div>
                    </div>
                    @include('frest-components.submit-button', [
                        'classes' => 'btn btn-primary glow w-100 position-relative mt-2',
                        'id' => 'login_btn',
                        'content' => __('global.login'),
                        'icon' => arrowIcon(),
                    ])
                </form>
            </div>
        </div>
    </div>
</div>


@section('scripts')
@endsection
