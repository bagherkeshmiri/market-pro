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
                                                        @include('frest-components.input',[ 'type' => 'text' , 'wire' => 'title' , 'classes' => 'text-left' , 'id' => 'title' , 'dir' => 'ltr' , 'icon' => titleIcon() , 'attributes' => 'required' ])
                                                        @include('frest-components.validation-error',[ 'name' => 'title' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'isActive' , 'content' => 'وضعیت'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.simple-selectbox',[ 'data' => $statuses , 'id' => 'isActive' , 'wire' => 'isActive'  ,'attributes' => 'required' , 'isDefer' => true])
                                                        @include('frest-components.validation-error',[ 'name' => 'isActive' ])
                                                    </div>
                                                </div>


                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'type' , 'content' => 'نوع'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.simple-selectbox',[ 'data' => $types , 'id' => 'type' , 'wire' => 'type'  ,'attributes' => 'required', 'isLazy' => true])
                                                        @include('frest-components.validation-error',[ 'name' => 'type' ])
                                                    </div>
                                                </div>


                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'limitation' , 'content' => ' تعداد آیتم ها'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.input',[ 'type' => 'number' , 'wire' => 'limitation' , 'classes' => 'text-left' , 'id' => 'limitation' , 'dir' => 'ltr' , 'icon' => packageIcon() , 'attributes' => 'required'])
                                                        @include('frest-components.validation-error',[ 'name' => 'limitation' ])
                                                    </div>
                                                </div>




                                                <span>{{ $type }}</span>


                                                @if($type == \App\Enums\CollectionType::Product)
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'limitation' , 'content' => ' انتخاب محصول'] )
                                                            @include('frest-components.required-tag')
                                                            <div class="border p-2">
                                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3" style="padding-right: 0;">
                                                                    <div class="form-group">
                                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'category' , 'content' => 'دسته بندی'] )
                                                                        @include('frest-components.required-tag')
                                                                        @include('frest-components.simple-selectbox',[ 'data' => $categories , 'id' => 'category' , 'wire' => 'category'  ,'attributes' => 'required', 'isLazy' => true])
                                                                        @include('frest-components.validation-error',[ 'name' => 'category' ])
                                                                        @include('frest-components.small-tag',['classes' =>  'text-warning' , 'message' => 'جهت نمایش محصولات یک دسته را انتخاب کنید'])
                                                                    </div>
                                                                </div>

                                                                @include('frest-components.text-divider',['dividerClass'=>'divider-warning','title' => ' لیست محصولات دسته بندی '  . $selectedCategory ?? '', 'classes' => 'mt-2'])

                                                                <div class="col-12">
                                                                    @forelse($categoryProducts as $categoryProduct)
                                                                        @include('frest-components.avatar-chip', [
                                                                           'content' => $categoryProduct['name'],
                                                                           'avatarClass' => 'bg-success',
                                                                           'icon' => plusIcon(),
                                                                           'wire' => "selectProduct({$categoryProduct['id']},'{$categoryProduct['name']}')"
                                                                       ])
                                                                    @empty
                                                                        @include('frest-components.simple-chip',['content' => __('global.no_information_found') , 'id' => 'empty-chip'])

                                                                    @endforelse
                                                                </div>

                                                                @include('frest-components.text-divider',['dividerClass'=>'divider-danger','title' => ' محصولات انتخاب شده در کالکشن', 'classes' => 'mt-2'])

                                                                <div class="col-12">
                                                                    @forelse($selectedProducts as $selectedProduct)
                                                                        @include('frest-components.avatar-chip', [
                                                                               'content' => $selectedProduct['name'],
                                                                               'avatarClass' => 'bg-danger',
                                                                               'icon' => minusIcon(),
                                                                               'wire' => "unselectProduct({$selectedProduct['id']},'{$selectedProduct['name']}')"
                                                                           ])
                                                                    @empty
                                                                        @include('frest-components.simple-chip',['content' => __('global.no_selected_product')])

                                                                    @endforelse

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif


                                                @if($type == \App\Enums\CollectionType::Category)
                                                    <div class="col-12">
                                                        انتخاب دسته بندی
                                                    </div>
                                                @endif






                                                <div class="col-12 d-flex justify-content-end mt-2">
                                                    @include('frest-components.submit-button', [ 'classes' => 'btn btn-primary mr-1 mb-1' , 'id' => 'save_btn' , 'content' => __('global.save')  , 'icon' => saveIcon() ])
                                                    @include('frest-components.link-button',[ 'href' => route('admin.collection.index') , 'classes' => 'btn btn-danger mr-1 mb-1' , 'id' => 'cancel' , 'content' => __('global.cancel')  , 'icon' => arrowIcon() ])
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
