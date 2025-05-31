@section('title','ویرایش منو')


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
                            style=" border-left: 0 !important;">ویرایش منو</h5>
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

                                    <!-- Start Flash Message -->
                                @include('alerts.flash-message')
                                <!--  End Flash Message -->

                                    <form class="form" wire:submit.prevent="update">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'name' , 'content' => 'عنوان '] )
                                                        @include('frest-components.tags.required-tag')
                                                        @include('frest-components.inputs.input',[ 'type' => 'text' , 'wire' => 'title' , 'classes' => 'text-left' , 'id' => 'title' , 'dir' => 'ltr' , 'icon' => titleIcon() , 'attributes' => 'required' ])
                                                        @include('frest-components.form-validations.small-tag-error',[ 'name' => 'title' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-5 col-xl-5">
                                                    <div class="form-group">
                                                        @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'address' , 'content' => 'آدرس '] )
                                                        @include('frest-components.tags.required-tag')
                                                        @include('frest-components.inputs.input',[ 'type' => 'text' , 'wire' => 'address' , 'classes' => 'text-left' , 'id' => 'address' , 'dir' => 'ltr' , 'icon' => linkIcon() , 'attributes' => 'required' ])
                                                        @include('frest-components.form-validations.small-tag-error',[ 'name' => 'address' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-end mt-2">
                                                    @include('frest-components.inputs.buttons.submit-button', [ 'classes' => 'btn btn-primary mr-1 mb-1' , 'id' => 'save_btn' , 'content' => __('global.save')  , 'icon' => saveIcon() ])
                                                    @include('frest-components.inputs.buttons.link-button',[ 'href' => route('admin.faq.index') , 'classes' => 'btn btn-danger mr-1 mb-1' , 'id' => 'cancel' , 'content' => __('global.cancel')  , 'icon' => arrowIcon() ])
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
