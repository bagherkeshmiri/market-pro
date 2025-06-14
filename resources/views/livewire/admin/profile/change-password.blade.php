@section('title','تغییر رمز عبور')

@section('styles')

    @vite(['resources/css/frest/pages/page-user-profile.css'])
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
@endsection



<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="page-user-profile">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="user-profile-images">
                                    <img src="{{ asset('/build/images/profile-banner.jpg') }}"
                                         class="img-fluid rounded-top user-timeline-image"
                                         alt="user timeline image">
                                    <img src="{{ asset('/build/images/avatar-s-16.png') }}"
                                         class="user-profile-image rounded-circle" alt="user profile image" height="140"
                                         width="140">
                                </div>
                                <div class="user-profile-text">
                                    <h4 class="mb-0 text-bold-500 profile-text-color">{{ $admin->full_name }}</h4>
                                </div>
                                <div class="card-body px-0">
                                    <ul class="nav user-profile-nav justify-content-center justify-content-md-start nav-tabs border-bottom-0 mb-0"
                                        role="tablist">
                                        <li class="nav-item pb-0">
                                            <a class="nav-link d-flex px-1 align-items-center" id="main-tab"
                                               href="{{ route('admin.profile.index') }}">
                                                <i class="bx bx-home"></i><span
                                                    class="d-none d-md-block">اصلی</span></a>
                                        </li>
                                        <li class="nav-item pb-0">
                                            <a class=" nav-link d-flex px-1 active align-items-center" id="password-tab"
                                               data-toggle="tab" href="#password" aria-controls="password"
                                               role="tab" aria-selected="true"><i class="bx bx-lock"></i><span
                                                    class="d-none d-md-block">تغییر رمز عبور</span></a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row mx-auto">
                            <div class="col-lg-12  px-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="password" aria-labelledby="password-tab"
                                         role="tabpanel">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">

                                                    @include('frest-components.flash-message')


                                                    <form class="form" wire:submit.prevent="change">
                                                        @csrf
                                                        <div class="form-body">
                                                            <div class="row">

                                                                <div class="col-md-4 col-12">
                                                                    <div class="form-group">
                                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'old_pass' , 'content' => 'رمز عبور قبلی'] )
                                                                        @include('frest-components.required-tag')
                                                                        @include('frest-components.input',[ 'type' => 'password' , 'wire' => 'oldPass' , 'classes' => 'text-left' , 'id' => 'oldPass' , 'dir' => 'ltr' , 'icon' => lockIcon() , 'attributes' => 'required' ])
                                                                        @include('frest-components.small-tag-error',[ 'name' => 'oldPass' ])
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-4 col-12">
                                                                    <div class="form-group">
                                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'password' , 'content' => 'رمز عبور جدید'] )
                                                                        @include('frest-components.required-tag')
                                                                        @include('frest-components.input',[ 'type' => 'password' , 'wire' => 'password' , 'classes' => 'text-left' , 'id' => 'password' , 'dir' => 'ltr' , 'icon' => lockIcon() , 'attributes' => 'required' ])
                                                                        @include('frest-components.small-tag-error',[ 'name' => 'password' ])
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-4 col-12">
                                                                    <div class="form-group">
                                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'password_confirmation' , 'content' => ' تکرار رمز عبور جدید'] )
                                                                        @include('frest-components.required-tag')
                                                                        @include('frest-components.input',[ 'type' => 'password' , 'wire' => 'password_confirmation' , 'classes' => 'text-left' , 'id' => 'password_confirmation' , 'dir' => 'ltr' , 'icon' => lockIcon() , 'attributes' => 'required' ])
                                                                        @include('frest-components.small-tag-error',[ 'name' => 'password_confirmation' ])
                                                                    </div>
                                                                </div>


                                                                <div class="col-12 d-flex justify-content-end">
                                                                    @include('frest-components.submit-button', [ 'classes' => 'btn btn-primary mr-1 mb-1' , 'id' => 'save_btn' , 'content' => 'تغییر'  , 'icon' => saveIcon() ])
                                                                    @include('frest-components.link-button',[ 'href' => route('admin.profile.index') , 'classes' => 'btn btn-danger mr-1 mb-1' , 'id' => 'cancel' , 'content' => __('global.cancel')  , 'icon' => arrowIcon() ])
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
@endsection
