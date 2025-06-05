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

            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">

                                    <!-- Start Flash Message -->
                                    @include('alerts.flash-message')
                                    <!--  End Flash Message -->

                                    <form class="form" wire:submit.prevent="store">
                                        <div class="form-body">
                                            <div class="row">

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'name' , 'content' => 'نام '] )
                                                        @include('frest-components.tags.required-tag')
                                                        @include('frest-components.inputs.input',[ 'type' => 'text' , 'wire' => 'name' , 'classes' => 'text-left' , 'id' => 'name' , 'dir' => 'ltr' , 'icon' => titleIcon() , 'attributes' => 'required' ])
                                                        @include('frest-components.form-validations.small-tag-error',[ 'name' => 'name' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'categoryId' , 'content' => 'دسته محصول'] )
                                                        @include('frest-components.inputs.simple-selectbox.simple-selectbox',[ 'data' => $allCategories , 'id' => 'categoryId' , 'wire' => 'categoryId'  , 'defaultOption' => true , 'defaultValue' => true])
                                                        @include('frest-components.form-validations.small-tag-error',[ 'name' => 'categoryId' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'price' , 'content' => 'قیمت ( تومان )'] )
                                                        @include('frest-components.tags.required-tag')
                                                        @include('frest-components.inputs.input',[ 'type' => 'text' , 'wire' => 'price' , 'classes' => 'text-left' , 'id' => 'price' , 'dir' => 'ltr' , 'icon' => dollarIcon() , 'attributes' => 'required' , 'isPriceInput' => true])
                                                        @include('frest-components.form-validations.small-tag-error',[ 'name' => 'price' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'stock' , 'content' => ' تعداد موجودی'] )
                                                        @include('frest-components.tags.required-tag')
                                                        @include('frest-components.inputs.input',[ 'type' => 'text' , 'wire' => 'stock' , 'classes' => 'text-left' , 'id' => 'stock' , 'dir' => 'ltr' , 'icon' => packageIcon() , 'attributes' => 'required'])
                                                        @include('frest-components.form-validations.small-tag-error',[ 'name' => 'stock' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mt-2">
                                                    <div class="form-group">
                                                        @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'mainImage' , 'content' => 'آپلود تصویر اصلی'] )
                                                        @include('frest-components.tags.required-tag')
                                                        @include('frest-components.inputs.file-upload.simple-file-upload', ['wire' => 'mainImage' , 'id' => 'mainImage'])
                                                        @include('frest-components.form-validations.small-tag-error',[ 'name' => 'mainImage' ])
                                                    </div>
                                                </div>


                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mt-2">
                                                    <div class="form-group">
                                                        @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'galleryImages' , 'content' => 'آپلود گالری تصاویر '] )
                                                        @include('frest-components.inputs.file-upload.simple-file-upload', ['wire' => 'galleryImages' , 'id' => 'galleryImages' , 'isMultiple' => true])
                                                        @include('frest-components.form-validations.small-tag-error',[ 'name' => 'galleryImages' ])
                                                    </div>
                                                </div>


                                                <div class="col-md-12 col-12 mb-2 my-2" wire:ignore>
                                                    @include('frest-components.inputs.label',[ 'classes' => 'text-bold-700' , 'for' => 'textarea-counter' , 'content' => 'توضیحات '] )
                                                    @include('frest-components.inputs.ckEditor',[ 'wire' => 'description'])
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

        </div>
    </div>
</div>


@section('scripts')
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('ckeditor5-35.3.2/build/ckeditor.js') }}"></script>


    <script>

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
                })
                .catch(error => {
                    console.error(error);
                });


        saveBtn.addEventListener('click', function () {
            @this.
            set('description', document.querySelector('#editor').innerHTML);
        });


        function formatPrice(input) {
            let value = input.value.replace(/[^0-9]/g, '').replace(/^0+/, '');
            input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

    </script>
@endsection
