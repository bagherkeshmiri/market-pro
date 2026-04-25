<div>
    @if ($canSubmit)
        <div class="blog-contact-form form-2 review-form">
            <div class="request-form">
                <form wire:submit.prevent="submit" class="form-horizontal">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-item">

                                @include('custom-components.site.label', [
                                    'for' => 'name',
                                    'content' => 'نام شما',
                                    'classes' => ''
                                ])

                                @include('custom-components.site.required-tag')

                                @include('custom-components.site.input', [
                                    'type' => 'text',
                                    'wire' => 'name',
                                    'classes' => '',
                                    'id' => 'name',
                                    'attributes' => 'required',
                                ])

                                @include('custom-components.site.validation-error',[ 'name' => 'name'] )
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-item">

                                @include('custom-components.site.label', [
                                   'for' => 'email',
                                   'content' => 'ایمیل شما',
                                   'classes' => ''
                               ])

                                @include('custom-components.site.required-tag')

                                @include('custom-components.site.input', [
                                   'type' => 'email',
                                   'wire' => 'email',
                                   'classes' => '',
                                   'id' => 'email',
                                   'attributes' => 'required',
                                ])

                                @include('custom-components.site.validation-error',[ 'name' => 'email'] )
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-item message-item">

                                @include('custom-components.site.label', [
                                    'for' => 'message',
                                    'content' => 'نظر شما',
                                    'classes' => ''
                                ])

                                @include('custom-components.site.required-tag')

                                @include('custom-components.site.textarea', [
                                    'type' => 'text',
                                    'wire' => 'message',
                                    'classes' => 'address',
                                    'id' => 'message',
                                    'attributes' => 'required',
                                ])

                                @include('custom-components.site.validation-error',[ 'name' => 'message'] )
                            </div>
                        </div>
                    </div>
                    <div class="submit-btn">
                        <button id="submit" class="rr-primary-btn" type="submit">ثبت نظر</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="alert alert-info mt-2">
            شما در 24 ساعت گذشته برای این محصول نظر ثبت کرده‌اید. لطفا بعد از گذشت 24 ساعت دوباره تلاش کنید.
        </div>
    @endif
</div>
