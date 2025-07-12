<div>
    @if ($canSubmit)
        <div class="blog-contact-form form-2 review-form">
            <div class="request-form">
                <form wire:submit.prevent="submit" class="form-horizontal">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-item">
                                <label for="name">نام شما</label>
                                @include('custom-components.site.required-tag')
                                <input type="text" id="name" wire:model.defer="name" class="form-control" required>
                                @include('custom-components.site.validation-error',[ 'name' => 'name'] )
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-item">
                                <label for="email">ایمیل شما</label>
                                @include('custom-components.site.required-tag')
                                <input type="email" id="email" wire:model.defer="email" class="form-control" required>
                                @include('custom-components.site.validation-error',[ 'name' => 'email'] )
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-item message-item">
                                <label for="message">نظر شما</label>
                                @include('custom-components.site.required-tag')
                                <textarea id="message" wire:model.defer="message" cols="30" rows="5" class="form-control address" required></textarea>
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
