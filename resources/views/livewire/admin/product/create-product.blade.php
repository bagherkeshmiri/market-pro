@section('title',$pageTitle)


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

                                    <form class="form" wire:submit.prevent="store">
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
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'categoryId' , 'content' => 'دسته محصول'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.simple-selectbox',[ 'data' => $allCategories , 'id' => 'categoryId' , 'wire' => 'categoryId'  ,'isDefer' => true,'attributes' => 'required'])
                                                        @include('frest-components.validation-error',[ 'name' => 'categoryId' ])
                                                    </div>
                                                </div>


                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'status' , 'content' => 'وضعیت'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.simple-selectbox',[ 'data' => $statuses , 'id' => 'status' , 'wire' => 'status'  ,'isDefer' => true,'attributes' => 'required'])
                                                        @include('frest-components.validation-error',[ 'name' => 'status' ])
                                                    </div>
                                                </div>


                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'price' , 'content' => 'قیمت ( تومان )'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.input',[ 'type' => 'text' , 'wire' => 'price' , 'classes' => 'text-left' , 'id' => 'price' , 'dir' => 'ltr' , 'icon' => dollarIcon() , 'attributes' => 'required' , 'isPriceInput' => true])
                                                        @include('frest-components.validation-error',[ 'name' => 'price' ])
                                                    </div>
                                                </div>


                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mt-2">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'stock' , 'content' => ' تعداد موجودی'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.input',[ 'type' => 'number' , 'wire' => 'stock' , 'classes' => 'text-left' , 'id' => 'stock' , 'dir' => 'ltr' , 'icon' => packageIcon() , 'attributes' => 'required'])
                                                        @include('frest-components.validation-error',[ 'name' => 'stock' ])
                                                    </div>
                                                </div>


                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mt-2">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'discountType' , 'content' => 'نوع تخفیف'] )
                                                        @include('frest-components.simple-selectbox',[ 'data' => $discountTypes , 'id' => 'discountType' , 'wire' => 'discountType','isDefer' => true])
                                                        @include('frest-components.validation-error',[ 'name' => 'discountType' ])
                                                    </div>
                                                </div>


                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mt-2">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'discount' , 'content' => ' تخفیف '] )
                                                        @include('frest-components.input',[ 'type' => 'number' , 'wire' => 'discount' , 'classes' => 'text-left' , 'id' => 'discount' , 'dir' => 'ltr' , 'icon' => dollarIcon()])
                                                        @include('frest-components.validation-error',[ 'name' => 'discount' ])
                                                    </div>
                                                </div>


                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mt-2">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'mainImage' , 'content' => 'آپلود تصویر اصلی'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.simple-file-upload', ['wire' => 'mainImage' , 'id' => 'mainImage'])
                                                        @include('frest-components.validation-error',[ 'name' => 'mainImage' ])
                                                    </div>
                                                </div>


                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mt-2">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'galleryImages' , 'content' => 'آپلود گالری تصاویر '] )
                                                        @include('frest-components.simple-file-upload', ['wire' => 'galleryImages' , 'id' => 'galleryImages' , 'isMultiple' => true])
                                                        @include('frest-components.validation-error',[ 'name' => 'galleryImages' ])
                                                    </div>
                                                </div>


                                                <div class="col-md-12 col-12 mb-2 my-2" wire:ignore>
                                                    @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'textarea-counter' , 'content' => 'توضیحات طولانی '] )
                                                    @include('frest-components.ckEditor',['id'=> 'long-description', 'wire' => 'long_description'])
                                                </div>


                                                <div class="col-md-12 col-12 mb-2 my-2" wire:ignore>
                                                    @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'textarea-counter' , 'content' => ' شرح مختصر '] )
                                                    @include('frest-components.ckEditor',[ 'id'=> 'short-description','wire' => 'short_description'])
                                                </div>


                                                <div class="col-md-12 col-12 mb-2 my-2" wire:ignore>
                                                    @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'textarea-counter' , 'content' => ' توضیحات تکمیلی  '] )
                                                    @include('frest-components.ckEditor',[ 'id'=> 'additional-information','wire' => 'additional_information'])
                                                </div>


                                                <div class="col-12 d-flex justify-content-end mt-2">
                                                    @include('frest-components.submit-button', [ 'classes' => 'btn btn-primary mr-1 mb-1' , 'id' => 'save_btn' , 'content' => __('global.save')  , 'icon' => saveIcon() ])
                                                    @include('frest-components.link-button',[ 'href' => route('admin.product.index') , 'classes' => 'btn btn-danger mr-1 mb-1' , 'id' => 'cancel' , 'content' => __('global.cancel')  , 'icon' => arrowIcon() ])
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
{{--    <script src="{{ asset('js/axios.min.js') }}"></script>--}}
    <script src="{{ asset('ckeditor5-35.3.2/build/ckeditor.js') }}"></script>

    @php
        $amountDiscountType = \App\Enums\DiscountType::Amount->value;
    @endphp

    <script>
        let jsAmountDiscountType = @json($amountDiscountType);
        let saveBtn = document.querySelector('#save_btn');
        let discountInput = document.getElementById('discount');

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

        const longDescriptionEditor =
            DecoupledDocumentEditor
                .create(document.querySelector('#long-description'), {
                    extraPlugins: [MyCustomUploadAdapterPlugin],
                    language: {
                        ui: 'fa',
                        content: 'fa',
                    },
                })
                .then(editor => {
                    const toolbarContainer = document.querySelector('#toolbar-container-long-description');
                    toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                })
                .catch(error => {
                    console.error(error);
                });


        const shortDescriptionEditor =
            DecoupledDocumentEditor
                .create(document.querySelector('#short-description'), {
                    extraPlugins: [MyCustomUploadAdapterPlugin],
                    language: {
                        ui: 'fa',
                        content: 'fa',
                    },
                })
                .then(editor => {
                    const toolbarContainer = document.querySelector('#toolbar-container-short-description');
                    toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                })
                .catch(error => {
                    console.error(error);
                })



        const additionalInformationEditor =
            DecoupledDocumentEditor
                .create(document.querySelector('#additional-information'), {
                    extraPlugins: [MyCustomUploadAdapterPlugin],
                    language: {
                        ui: 'fa',
                        content: 'fa',
                    },
                })
                .then(editor => {
                    const toolbarContainer = document.querySelector('#toolbar-container-additional-information');
                    toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                })
                .catch(error => {
                    console.error(error);
                });

        saveBtn.addEventListener('click', function () {
            @this.set('longDescription', document.querySelector('#long-description').innerHTML);
            @this.set('shortDescription', document.querySelector('#short-description').innerHTML);
            @this.set('additionalInformation', document.querySelector('#additional-information').innerHTML);
        });


        function formatPrice(input) {
            if (input.type !== 'text' && input.tagName.toLowerCase() !== 'textarea') {
                return;
            }
            let cursorPosition = input.selectionStart;
            let value = input.value.replace(/[^0-9]/g, '').replace(/^0+/, '');
            let formatted = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            let diff = formatted.length - input.value.length;
            input.value = formatted;
            if (typeof input.setSelectionRange === 'function') {
                input.setSelectionRange(cursorPosition + diff, cursorPosition + diff);
            }
        }

        window.addEventListener('DOMContentLoaded', function () {
            let input = document.getElementById('price');
            if (input) {
                formatPrice(input);
            }

            if (discountInput) {
                formatPrice(discountInput);

                discountInput.addEventListener('input', function () {
                    const discountType = Number(document.getElementById('discountType').value);
                    if (discountType === jsAmountDiscountType) {
                        formatPrice(discountInput);
                    }
                });
            }

        });


        document.getElementById('discountType').addEventListener('change', function () {
            let discountType = Number(this.value);

            if (discountType === jsAmountDiscountType) {
                if (discountInput.type === 'number') {
                    discountInput.type = 'text';
                    discountInput.value = 0;
                }
            } else {
                if (discountInput.type === 'text') {
                    discountInput.type = 'number';
                }
            }

            discountInput.value = 0;

        });

    </script>
@endsection
