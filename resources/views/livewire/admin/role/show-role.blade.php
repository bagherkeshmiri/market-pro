@section('title','ویرایش نقش')


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
                                    <!--  End Flash Message -->

                                    <form class="form" wire:submit.prevent="update">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">

                                                <div class="col-md-5 col-12">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'name' , 'content' => 'نام نقش '] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.input',[ 'type' => 'text' , 'name' => 'faName' , 'wire' => 'faName' , 'classes' => 'text-left' , 'id' => 'faName' , 'dir' => 'ltr' , 'icon' => lockIcon() , 'attributes' => 'required' ])
                                                        @include('frest-components.small-tag-error',[ 'name' => 'faName' ])
                                                    </div>
                                                </div>


                                                <div class="col-md-5 col-12">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'name' , 'content' => 'نام نقش '] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.input',[ 'type' => 'text' , 'name' => 'enName' , 'wire' => 'enName' , 'classes' => 'text-left' , 'id' => 'enName' , 'dir' => 'ltr' , 'icon' => lockIcon() , 'attributes' => 'required' ])
                                                        @include('frest-components.small-tag-error',[ 'name' => 'enName' ])
                                                    </div>
                                                </div>

                                                <div class="col-md-2 col-12 align-self-end">
                                                    <div class="form-group">
                                                        @include('frest-components.sm-checkbox',['checkboxClass'=>'checkbox-warning', 'label_content' => 'انتخاب همه'  , 'id' => 'selectAll' , 'for' => 'selectAll' , 'wireSimple' => 'selectAll' ])
                                                    </div>
                                                </div>

                                                @include('frest-components.text-divider',['dividerClass'=> 'divider-warning','title' => 'سطوح دسترسی'])


                                                @error('permissions[]')
                                                <div class="col-md-12 col-12 text-center mb-2">
                                                    @include('frest-components.small-tag-error',['name' => 'permissions[]'])
                                                </div>
                                                @enderror


                                                @foreach($allPermissions as $permission)
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            @include('frest-components.sm-checkbox',[ 'checkboxClass'=> 'checkbox-warning','label_content' => $permission->fa_name  , 'id' => 'permission'.$permission->id , 'for' => 'permission'.$permission->id  , 'wire' => 'permissions' , 'value' => $permission->id ])
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <div class="col-12 d-flex justify-content-end mt-2">
                                                    @include('frest-components.submit-button', [ 'classes' => 'btn btn-primary mr-1 mb-1' , 'id' => 'save_btn' , 'content' => __('global.edit')  , 'icon' => saveIcon() ])
                                                    @include('frest-components.link-button',[ 'href' => route('admin.role.index') , 'classes' => 'btn btn-danger mr-1 mb-1' , 'id' => 'cancel' , 'content' => __('global.cancel')  , 'icon' => arrowIcon() ])
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
