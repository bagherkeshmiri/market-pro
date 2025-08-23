<div>
    @include('frest-components.flash-message')

    <form class="form" wire:submit.prevent="change">
        @csrf
        <div class="form-body">
            <div class="row">

                <div class="col-md-4 col-12">
                    <div class="form-group">
                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'old_pass' , 'content' => 'رمز عبور قبلی'] )
                        @include('frest-components.required-tag')
                        @include('frest-components.input',[ 'type' => 'password' , 'wire' => 'oldPass' , 'classes' => 'text-left' , 'id' => 'oldPass' , 'icon' => lockIcon() , 'attributes' => 'required' ])
                        @include('frest-components.validation-error',[ 'name' => 'oldPass' ])
                    </div>
                </div>


                <div class="col-md-4 col-12">
                    <div class="form-group">
                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'password' , 'content' => 'رمز عبور جدید'] )
                        @include('frest-components.required-tag')
                        @include('frest-components.input',[ 'type' => 'password' , 'wire' => 'password' , 'classes' => 'text-left' , 'id' => 'password' , 'icon' => lockIcon() , 'attributes' => 'required' ])
                        @include('frest-components.validation-error',[ 'name' => 'password' ])
                    </div>
                </div>


                <div class="col-md-4 col-12">
                    <div class="form-group">
                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'password_confirmation' , 'content' => ' تکرار رمز عبور جدید'] )
                        @include('frest-components.required-tag')
                        @include('frest-components.input',[ 'type' => 'password' , 'wire' => 'password_confirmation' , 'classes' => 'text-left' , 'id' => 'password_confirmation' , 'icon' => lockIcon() , 'attributes' => 'required' ])
                        @include('frest-components.validation-error',[ 'name' => 'password_confirmation' ])
                    </div>
                </div>


                <div class="col-12 d-flex justify-content-end mt-2">
                    @include('frest-components.submit-button', [ 'classes' => 'btn btn-primary mr-1 mb-1' , 'id' => 'save_btn' , 'content' => 'تغییر'  , 'icon' => saveIcon() ])
                    @include('frest-components.link-button',[ 'href' => route('admin.profile.index') , 'classes' => 'btn btn-danger mr-1 mb-1' , 'id' => 'cancel' , 'content' => __('global.cancel')  , 'icon' => arrowIcon() ])
                </div>
            </div>
        </div>
    </form>
</div>
