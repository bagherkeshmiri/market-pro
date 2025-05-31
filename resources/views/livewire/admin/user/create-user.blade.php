@section('title',$pageTitle)


@section('styles')
@endsection




<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h5 class="content-header-title float-left pr-1 text-success "
                            style=" border-left: 0 !important;">{{ $pageTitle }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">

            <!-- // Basic multiple Column Form section start -->
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">

                                    {{-- Start Flash Message --}}
                                    @include('alerts.flash-message')
                                    {{-- End Flash Message --}}


                                    <form class="form" wire:submit.prevent="store">

                                        <div class="form-body">
                                            <div class="row">

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'name' , 'content' => 'نام '] )
                                                        @include('frest-components.tags.required-tag')
                                                        @include('frest-components.inputs.input',[ 'type' => 'text' , 'wire' => 'name' , 'classes' => 'text-left' , 'id' => 'name' , 'dir' => 'ltr' , 'icon' => userIcon() , 'tabindex' => '1' , 'attributes' => 'required' ])
                                                        @include('frest-components.form-validations.small-tag-error',[ 'name' => 'name' ])
                                                    </div>
                                                </div>


                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'family' , 'content' => 'نام خانوادگی'] )
                                                        @include('frest-components.tags.required-tag')
                                                        @include('frest-components.inputs.input',[ 'type' => 'text' , 'wire' => 'family' , 'classes' => 'text-left' , 'id' => 'family' , 'dir' => 'ltr' , 'icon' => userIcon() , 'tabindex' => '2' , 'attributes' => 'required' ])
                                                        @include('frest-components.form-validations.small-tag-error',[ 'name' => 'family' ])
                                                    </div>
                                                </div>


                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'mobile' , 'content' => 'موبایل'] )
                                                        @include('frest-components.tags.required-tag')
                                                        @include('frest-components.inputs.input',[ 'type' => 'number' , 'wire' => 'mobile' , 'classes' => 'text-left' , 'id' => 'mobile' , 'dir' => 'ltr' , 'icon' => mobileIcon() , 'tabindex' => '3' , 'attributes' => 'required' ])
                                                        @include('frest-components.form-validations.small-tag-error',[ 'name' => 'mobile' ])
                                                    </div>
                                                </div>


                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'userName' , 'content' => 'نام کاربری'] )
                                                        @include('frest-components.tags.required-tag')
                                                        @include('frest-components.inputs.input',[ 'type' => 'text' , 'wire' => 'userName' , 'classes' => 'text-left' , 'id' => 'userName' , 'dir' => 'ltr' , 'icon' => userIcon() , 'tabindex' => '4' , 'attributes' => 'required' ])
                                                        @include('frest-components.form-validations.small-tag-error',[ 'name' => 'userName' ])
                                                    </div>
                                                </div>


                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'password' , 'content' => 'رمز عبور '] )
                                                        @include('frest-components.tags.required-tag')
                                                        @include('frest-components.inputs.input',[ 'type' => 'password' , 'wire' => 'password' , 'classes' => 'text-left' , 'id' => 'password' , 'dir' => 'ltr' , 'icon' => lockIcon() , 'tabindex' => '5' , 'attributes' => 'required' ])
                                                        @include('frest-components.form-validations.small-tag-error',[ 'name' => 'password' ])
                                                    </div>
                                                </div>


                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'role' , 'content' => 'نقش'] )
                                                        @include('frest-components.tags.required-tag')
                                                        @include('frest-components.inputs.simple-selectbox.simple-selectbox',[ 'data' => $roles , 'id' => 'role' , 'wire' => 'role' ])
                                                        @include('frest-components.form-validations.small-tag-error',[ 'name' => 'role' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-end">
                                                    @include('frest-components.inputs.buttons.submit-button', [ 'classes' => 'btn btn-primary mr-1 mb-1' , 'id' => 'save_btn' , 'content' => __('global.save')  , 'icon' => saveIcon() ])
                                                    @include('frest-components.inputs.buttons.link-button',[ 'href' => route('admin.user.index') , 'classes' => 'btn btn-danger mr-1 mb-1' , 'id' => 'cancel' , 'content' => __('global.cancel')  , 'icon' => arrowIcon() ])
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
            <!-- // Basic multiple Column Form section end -->

        </div>
    </div>
</div>




@section('scripts')
@endsection
