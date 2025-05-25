@section('title','ویرایش دسته بندی')


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
                            style=" border-left: 0 !important;">ویرایش دسته بندی</h5>
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
                                                        @include('frest-components.form-valiations.small-tag-error',[ 'name' => 'title' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'name' , 'content' => 'عنوان سئو '] )
                                                        @include('frest-components.tags.required-tag')
                                                        @include('frest-components.inputs.input',[ 'type' => 'text' , 'wire' => 'seoTitle' , 'classes' => 'text-left' , 'id' => 'seoTitle' , 'dir' => 'ltr' , 'icon' => titleIcon() , 'attributes' => 'required'])
                                                        @include('frest-components.form-valiations.small-tag-error',[ 'name' => 'seoTitle' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'enTitle' , 'content' => 'عنوان لاتین '] )
                                                        @include('frest-components.tags.required-tag')
                                                        @include('frest-components.inputs.input',[ 'type' => 'text' , 'wire' => 'enTitle' , 'classes' => 'text-left' , 'id' => 'enTitle' , 'dir' => 'ltr' , 'icon' => titleIcon() , 'attributes' => 'required'])
                                                        @include('frest-components.form-valiations.small-tag-error',[ 'name' => 'enTitle' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'parentId' , 'content' => 'دسته پدر'] )
                                                        @include('frest-components.inputs.simple-selectbox.simple-selectbox',[ 'data' => $allCategories , 'id' => 'parentId' , 'wire' => 'parentId'  , 'defaultOption' => true , 'defaultValue' => true ])
                                                        @include('frest-components.form-valiations.small-tag-error',[ 'name' => 'parentId' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'type' , 'content' => 'نوع دسته بندی'] )
                                                        @include('frest-components.tags.required-tag')
                                                        @include('frest-components.inputs.simple-selectbox.simple-selectbox',[ 'data' => $categoryType , 'id' => 'type' , 'wire' => 'type' ])
                                                        @include('frest-components.form-valiations.small-tag-error',[ 'name' => 'type' ])
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12 mb-2">
                                                    @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'textarea-counter' , 'content' => 'توضیحات '] )
                                                    @include('frest-components.inputs.ckEditor')
                                                </div>


                                                <div class="col-12 d-flex justify-content-end mt-2">
                                                    @include('frest-components.inputs.buttons.submit-button', [ 'classes' => 'btn btn-primary mr-1 mb-1' , 'id' => 'save_btn' , 'content' => __('global.save')  , 'icon' => saveIcon() ])
                                                    @include('frest-components.inputs.buttons.link-button',[ 'href' => route('admin.category.index') , 'classes' => 'btn btn-danger mr-1 mb-1' , 'id' => 'cancel' , 'content' => __('global.cancel')  , 'icon' => arrowIcon() ])
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
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('ckeditor5-35.3.2/build/ckeditor.js') }}"></script>
    <script>

        let description = @js($description);
        let saveBtn = document.querySelector('#save_btn');

        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return {
                    upload() {
                        return loader.file.then(file => new Promise((resolve, reject) => {
                                let formData = new FormData();
                                formData.append('image', file)
                                axios.post('{{ route('api.upload') }}', formData, {
                                    headers: {'Content_type': 'multipart/form-data'}
                                }).then(response => {
                                    resolve({
                                        default: response.data
                                    })
                                })
                            }
                        ))
                    },
                    abort() {
                    },
                }
            }
        }

        const myEditor =
            DecoupledDocumentEditor
                .create(document.querySelector('#editor'), {
                    extraPlugins: [MyCustomUploadAdapterPlugin],
                    language: {
                        ui: 'fa',
                        content: 'fa',
                    },
                })
                .then(editor => {
                    const toolbarContainer = document.querySelector('#toolbar-container');
                    toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                    editor.setData(description);
                })
                .catch(error => {
                    console.error(error);
                });


        saveBtn.addEventListener('click', function () {
            @this.
            set('description', document.querySelector('#editor').innerHTML);
        });

    </script>
@endsection
