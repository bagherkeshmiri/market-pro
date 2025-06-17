@section('title',$pageTitle)


@section('styles')
@endsection


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
{{--        @include('custom-components.admin.page-title',['pageTitle' => $pageTitle,])--}}
        <div class="content-body">

            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">

                                    @include('frest-components.flash-message')


                                    <form class="form" wire:submit.prevent="update">

                                        <div class="form-body">
                                            <div class="row">

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'name' , 'content' => 'نام '] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.input',[ 'type' => 'text' , 'wire' => 'name' , 'classes' => 'text-left' , 'id' => 'name' , 'dir' => 'ltr' , 'icon' => userIcon() , 'tabindex' => '1' , 'attributes' => 'required' ])
                                                        @include('frest-components.small-tag-error',[ 'name' => 'name' ])
                                                    </div>
                                                </div>


                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'email' , 'content' => 'ایمیل '] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.input',[ 'type' => 'text' , 'wire' => 'email' , 'classes' => 'text-left' , 'id' => 'email' , 'dir' => 'ltr' , 'icon' => emailIcon() , 'tabindex' => '4' , 'attributes' => 'required' ])
                                                        @include('frest-components.small-tag-error',[ 'name' => 'email' ])
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'type' , 'content' => 'نوع کاربری'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.simple-selectbox',[ 'data' => $types , 'id' => 'type' , 'wire' => 'type' ])
                                                        @include('frest-components.small-tag-error',[ 'name' => 'type' ])
                                                    </div>

                                                </div>


                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'role' , 'content' => 'نقش'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.simple-selectbox',[ 'data' => $roles , 'id' => 'role' , 'wire' => 'role' ])
                                                        @include('frest-components.small-tag-error',[ 'name' => 'role' ])
                                                    </div>

                                                </div>

                                                <div class="col-12 d-flex justify-content-end">
                                                    @include('frest-components.submit-button', [ 'classes' => 'btn btn-primary mr-1 mb-1' , 'id' => 'save_btn' , 'content' => __('global.save')  , 'icon' => saveIcon() ])
                                                    @include('frest-components.link-button',[ 'href' =>  route('admin.user.index'), 'classes' => 'btn btn-danger mr-1 mb-1' , 'id' => 'cancel' , 'content' => __('global.cancel')  , 'icon' => arrowIcon() ])
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
@endsection
