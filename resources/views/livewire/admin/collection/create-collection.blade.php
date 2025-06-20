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
                                                        @include('frest-components.small-tag-error',[ 'name' => 'title' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'isActive' , 'content' => 'وضعیت'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.simple-selectbox',[ 'data' => $statuses , 'id' => 'isActive' , 'wire' => 'isActive'  ,'attributes' => 'required', 'defaultOption' => true , 'defaultValue' => true])
                                                        @include('frest-components.small-tag-error',[ 'name' => 'isActive' ])
                                                    </div>
                                                </div>


                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'type' , 'content' => 'نوع'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.simple-selectbox',[ 'data' => $types , 'id' => 'type' , 'wire' => 'type'  ,'attributes' => 'required', 'defaultOption' => true , 'defaultValue' => true])
                                                        @include('frest-components.small-tag-error',[ 'name' => 'type' ])
                                                    </div>
                                                </div>


                                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'limitation' , 'content' => ' تعداد آیتم ها'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.input',[ 'type' => 'number' , 'wire' => 'limitation' , 'classes' => 'text-left' , 'id' => 'limitation' , 'dir' => 'ltr' , 'icon' => packageIcon() , 'attributes' => 'required'])
                                                        @include('frest-components.small-tag-error',[ 'name' => 'limitation' ])
                                                    </div>
                                                </div>


                                                <div class="col-12">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'limitation' , 'content' => ' انتخاب محصول'] )
                                                        @include('frest-components.required-tag')
                                                        <div class="border p-2">
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3" style="padding-right: 0;">
                                                                <div class="form-group">
                                                                    @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'category' , 'content' => 'دسته بندی'] )
                                                                    @include('frest-components.required-tag')
                                                                    @include('frest-components.simple-selectbox',[ 'data' => $categories , 'id' => 'category' , 'wire' => 'category'  ,'attributes' => 'required', 'defaultOption' => true , 'defaultValue' => true , 'isLazy' => true])
                                                                    @include('frest-components.small-tag-error',[ 'name' => 'category' ])
                                                                </div>
                                                            </div>


                                                            @include('frest-components.text-divider',['dividerClass'=>'divider-warning','title' => ' لیست محصولات'])


{{--                                                            @forelse($categoryProducts as $categoryProduct)--}}
{{--                                                                @include('frest-components.simple-chip',['content' => $categoryProduct->name])--}}
{{--                                                            @empty--}}
{{--                                                                <div class="chip mr-1">--}}
{{--                                                                    <div class="chip-body">--}}
{{--                                                                        --}}{{--                                                                    <span class="chip-text"> {{ $category?->id ?? '' }}</span>--}}
{{--                                                                        <span class="chip-text"> محصولی یافت نشد</span>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            @endforelse--}}


                                                            @include('frest-components.text-divider',['dividerClass'=>'divider-danger','title' => '  محصولات انتخاب شده در کالکشن'])

                                                            <div class="chip mr-1">
                                                                <div class="chip-body">
                                                                    {{--                                                                    <span class="chip-text"> {{ $category?->id ?? '' }}</span>--}}
                                                                    <span class="chip-text"> تست</span>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>


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
