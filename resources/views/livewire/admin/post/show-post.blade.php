
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

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'title' , 'content' => 'عنوان'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.input',[ 'type' => 'text' , 'wire' => 'title' , 'classes' => 'text-left' , 'id' => 'title' , 'dir' => 'ltr' , 'icon' => titleIcon() , 'attributes' => 'required' ])
                                                        @include('frest-components.validation-error',[ 'name' => 'title' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'slug' , 'content' => 'اسلاگ'] )
                                                        @include('frest-components.required-tag')
                                                        <span class="text-warning pl-1" style="font-size: 0.7rem;">اسلاگ حتما باید انگلیسی وارد شود</span>
                                                        @include('frest-components.input',[ 'type' => 'text' , 'wire' => 'slug' , 'classes' => 'text-left' , 'id' => 'slug' , 'dir' => 'ltr' , 'icon' => titleIcon() , 'attributes' => 'required' ])
                                                        @include('frest-components.validation-error',[ 'name' => 'slug' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'status' , 'content' => 'وضعیت'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.simple-selectbox',[ 'data' => $statuses , 'id' => 'status' , 'wire' => 'status'  ,'isDefer' => true,'attributes' => 'required'])
                                                        @include('frest-components.validation-error',[ 'name' => 'status' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'categoryId' , 'content' => 'دسته پست '] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.simple-selectbox',[ 'data' => $categories , 'id' => 'categoryId' , 'wire' => 'categoryId'  ,'isDefer' => true,'attributes' => 'required'])
                                                        @include('frest-components.validation-error',[ 'name' => 'categoryId' ])
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12 mb-2 my-2" wire:ignore>
                                                    @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'textarea-counter' , 'content' => ' متن پست'] )
                                                    @include('frest-components.required-tag')
                                                    @include('frest-components.ckEditor',['content' =>$post->body, 'id'=> 'body','wire' => 'body'])
                                                </div>


                                                <div class="col-12 d-flex justify-content-end mt-2">
                                                    @include('frest-components.submit-button', [ 'classes' => 'btn btn-primary mr-1 mb-1' , 'id' => 'save_btn' , 'content' => __('global.save')  , 'icon' => saveIcon() ])
                                                    @include('frest-components.link-button',[ 'href' => route('admin.post.index') , 'classes' => 'btn btn-danger mr-1 mb-1' , 'id' => 'cancel' , 'content' => __('global.cancel')  , 'icon' => arrowIcon() ])
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
        let bodyEditor;

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
            .create(document.querySelector('#body'), { extraPlugins: [MyCustomUploadAdapterPlugin], language: { ui: 'fa', content: 'fa' } })
            .then(editor => {
                bodyEditor = editor;
                document.querySelector('#toolbar-container-body').appendChild(editor.ui.view.toolbar.element);
            });

        saveBtn.addEventListener('click', function () {
            @this.set('body', bodyEditor.getData());
        });


    </script>
@endsection
