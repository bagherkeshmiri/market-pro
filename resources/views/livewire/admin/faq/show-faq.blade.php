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
                                        <div class="form-body">
                                            <div class="row">

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-8 col-xl-8">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'question' , 'content' => 'سوال '] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.input',[ 'type' => 'text' , 'wire' => 'question' , 'classes' => 'text-left' , 'id' => 'question' , 'dir' => 'ltr' , 'icon' => titleIcon() , 'attributes' => 'required' ])
                                                        @include('frest-components.validation-error',[ 'name' => 'question' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'isActive' , 'content' => 'وضعیت'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.simple-selectbox',[ 'data' => $statuses , 'id' => 'status' , 'wire' => 'isActive'  ,'isDefer' => true,'attributes' => 'required'])
                                                        @include('frest-components.validation-error',[ 'name' => 'isActive' ])
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12 mb-2 my-2" wire:ignore>
                                                    @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'textarea-counter' , 'content' => ' پاسخ'] )
                                                    @include('frest-components.required-tag')
                                                    @include('frest-components.ckEditor',['content' => $faq->answer, 'id'=> 'answer','wire' => 'answer'])
                                                </div>


                                                <div class="col-12 d-flex justify-content-end mt-2">
                                                    @include('frest-components.submit-button', [ 'classes' => 'btn btn-primary mr-1 mb-1' , 'id' => 'save_btn' , 'content' => __('global.save')  , 'icon' => saveIcon() ])
                                                    @include('frest-components.link-button',[ 'href' => route('admin.faq.index') , 'classes' => 'btn btn-danger mr-1 mb-1' , 'id' => 'cancel' , 'content' => __('global.cancel')  , 'icon' => arrowIcon() ])
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

    <script>
        let saveBtn = document.querySelector('#save_btn');
        let answerEditor;

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

        DecoupledDocumentEditor
            .create(document.querySelector('#answer'), { extraPlugins: [MyCustomUploadAdapterPlugin], language: { ui: 'fa', content: 'fa' } })
            .then(editor => {
                answerEditor = editor;
                document.querySelector('#toolbar-container-answer').appendChild(editor.ui.view.toolbar.element);
            });

        saveBtn.addEventListener('click', function () {
            @this.set('answer', answerEditor.getData());
        });


    </script>
@endsection
