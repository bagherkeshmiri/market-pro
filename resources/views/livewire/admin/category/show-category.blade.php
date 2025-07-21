
@section('styles')
@endsection


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-body">

            <section id="multiple-column-form">
                <div class="row match-height">

                    <div class="col-12">
                        <div class="card border">
                            <div class="card-content">
                                <div class="card-body">

                                    @include('frest-components.flash-message')

                                    <form class="form" wire:submit.prevent="update">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'name' , 'content' => 'نام '] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.input',[ 'type' => 'text' , 'wire' => 'name' , 'classes' => 'text-left' , 'id' => 'name' , 'dir' => 'ltr' , 'icon' => titleIcon() , 'attributes' => 'required' ])
                                                        @include('frest-components.validation-error',[ 'name' => 'name' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'parentId' , 'content' => 'دسته پدر'] )
                                                        @include('frest-components.simple-selectbox',[ 'data' => $allCategories , 'id' => 'parentId' , 'wire' => 'parentId'  ,'isDefer' => true, 'defaultValue' => true])
                                                        @include('frest-components.validation-error',[ 'name' => 'parentId' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'type' , 'content' => 'نوع دسته'] )
                                                        @include('frest-components.simple-selectbox',[ 'data' => $types , 'id' => 'type' , 'wire' => 'type'  ,'isDefer' => true , 'defaultValue' => true])
                                                        @include('frest-components.validation-error',[ 'name' => 'type' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'image' , 'content' => 'آپلود تصویر '] )
                                                        @include('frest-components.simple-file-upload', ['wire' => 'image' , 'id' => 'image'])
                                                        @include('frest-components.validation-error',[ 'name' => 'image' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'image' , 'content' => 'تصویر اصلی'] )
                                                        @if ($image)
                                                            <img src="{{ is_object($image) && method_exists($image, 'temporaryUrl') ? $image->temporaryUrl() : (file_exists(public_path($image)) ? asset($image) : asset($sampleImageUrl)) }}"
                                                                 class="img-fluid rounded-start d-block" alt="category-image" width="100" style="padding: 8px;" />
                                                        @else
                                                            <img src="{{ asset($sampleImageUrl) }}"
                                                                 class="img-fluid rounded-start d-block" width="100" alt="default-image"/>
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="col-12 d-flex justify-content-end mt-2">
                                                    @include('frest-components.submit-button', [ 'classes' => 'btn btn-primary mr-1 mb-1' , 'id' => 'save_btn' , 'content' => __('global.save')  , 'icon' => saveIcon() ])
                                                    @include('frest-components.link-button',[ 'href' => route('admin.category.index') , 'classes' => 'btn btn-danger mr-1 mb-1' , 'id' => 'cancel' , 'content' => __('global.cancel')  , 'icon' => arrowIcon() ])
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
