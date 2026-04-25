<div class="users-list-filter px-1">
    <form>
        <div class="row border rounded py-2 mb-2">


            <div class="col-12 col-sm-6 col-lg-3">
                <div class="form-group">
                    @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'name' , 'content' => 'نام '] )
                    @include('frest-components.input',[ 'type' => 'text' , 'wire' => 'name' , 'classes' => 'text-left' , 'id' => 'name' , 'icon' => userIcon() , 'tabindex' => '1' , 'attributes' => '' ])
                    @include('frest-components.validation-error',[ 'name' => 'name' ])
                </div>
            </div>



            <div class="col-12 col-sm-6 col-lg-3">
                <div class="form-group">
                    @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'categoryId' , 'content' => 'دسته محصول'] )
                    @include('frest-components.simple-selectbox',[ 'data' => [] , 'id' => 'categoryId' , 'wire' => 'categoryId'  ,'isDefer' => true,'attributes' => ''])
                    @include('frest-components.validation-error',[ 'name' => 'categoryId' ])
                </div>
            </div>


            <div class="col-12 col-sm-6 col-lg-3">
                <div class="form-group">
                    @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'status' , 'content' => 'وضعیت'] )
                    @include('frest-components.simple-selectbox',[ 'data' => [] , 'id' => 'status' , 'wire' => 'status'  ,'isDefer' => true,'attributes' => ''])
                    @include('frest-components.validation-error',[ 'name' => 'status' ])
                </div>
            </div>


            <div class="col-12 col-sm-6 col-lg-3">
                <div class="form-group">
                    @include('frest-components.label',[ 'classes' => 'text-bold-700' , 'for' => 'price' , 'content' => 'قیمت '] )
                    @include('frest-components.input',[ 'type' => 'text' , 'wire' => 'price' , 'classes' => 'text-left' , 'id' => 'price' , 'icon' => dollarIcon() , 'tabindex' => '1' , 'attributes' => '' ])
                    @include('frest-components.validation-error',[ 'name' => 'price' ])
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center " style="margin-top: 27px !important;">
                @include('frest-components.submit-button', [ 'classes' => 'btn btn-primary mr-1 mb-1' , 'id' => 'search_btn' , 'content' => __('global.search')  , 'icon' => searchIcon() ])
                @include('frest-components.submit-button', [ 'classes' => 'btn btn-secondary mr-1 mb-1' , 'id' => 'reset_btn' , 'content' => __('global.reset')  , 'icon' => resetIcon() ])
            </div>
        </div>
    </form>
</div>
