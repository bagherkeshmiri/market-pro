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


                                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'label' , 'content' => 'لیبل'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.input',[ 'type' => 'text' , 'wire' => 'label' , 'classes' => 'text-left' , 'id' => 'label' , 'icon' => titleIcon() , 'attributes' => 'required' ])
                                                        @include('frest-components.validation-error',[ 'name' => 'label' ])
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'gateId' , 'content' => 'درگاه'] )
                                                        @include('frest-components.required-tag')
                                                        @include('frest-components.simple-selectbox',[ 'data' => $this->gates , 'id' => 'gateId' , 'wire' => 'gateId'  ,'isDefer' => true,'attributes' => 'required'])
                                                        @include('frest-components.validation-error',[ 'name' => 'gateId' ])
                                                    </div>
                                                </div>

                                                <div class="col-6 col-sm-6 col-md-2 col-lg-2 col-xl-2 ">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'isActive' , 'content' => 'وضعیت'] )
                                                        @include('frest-components.required-tag')
                                                        <livewire:admin.custom-components.toggle-switch
                                                            model="isActive"
                                                            :value="$isActive"
                                                            wire:key="isActive-toggle-switch"
                                                        />
                                                    </div>
                                                </div>


                                                <div class="col-6 col-sm-6 col-md-2 col-lg-2 col-xl-2 ">
                                                    <div class="form-group">
                                                        @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'isDefault' , 'content' => 'پیشفرض'] )
                                                        @include('frest-components.required-tag')
                                                        <livewire:admin.custom-components.toggle-switch
                                                            model="isDefault"
                                                            :value="$isDefault"
                                                            wire:key="isDefault-toggle-switch"
                                                        />
                                                    </div>
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
@endsection
