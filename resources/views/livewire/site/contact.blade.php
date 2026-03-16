<di>
    <section class="contact-section pt-50 pb-50">
        <div class="container rtl">
            <div class="row contact-wrap">

                <div class="col-lg-8 col-md-12">
                    <div class="blog-contact-form form-2">
                        <div class="request-form">
                            <h2 class="form-title">با ما در تماس باشید</h2>
                            <form action="#" method="post" id="ajax_contact" class="form-horizontal">

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-item">

                                            @include('custom-components.site.label', [
                                                'for' => 'name',
                                                'content' => 'نام',
                                                'classes' => ''
                                            ])

                                            @include('custom-components.site.input', [
                                                'type' => 'text',
                                                'wire' => 'name',
                                                'classes' => '',
                                                'id' => 'name',
                                                'attributes' => null,
                                            ])

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-item">

                                            @include('custom-components.site.label', [
                                               'for' => 'email',
                                               'content' => 'ایمیل',
                                               'classes' => ''
                                           ])

                                            @include('custom-components.site.input', [
                                                'type' => 'email',
                                                'wire' => 'email',
                                                'classes' => '',
                                                'id' => 'email',
                                                'attributes' => 'required',
                                            ])

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">

                                            @include('custom-components.site.label', [
                                              'for' => 'subject',
                                              'content' => 'موضوع',
                                              'classes' => ''
                                            ])

                                            @include('custom-components.site.input', [
                                                'type' => 'subject',
                                                'wire' => 'subject',
                                                'classes' => '',
                                                'id' => 'subject',
                                                'attributes' => 'required',
                                            ])

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item message-item">

                                            @include('custom-components.site.label', [
                                             'for' => 'message',
                                             'content' => 'پیام خود را بنویسید',
                                             'classes' => ''
                                           ])

                                            @include('custom-components.site.textarea', [
                                                'type' => 'text',
                                                'wire' => 'subject',
                                                'classes' => 'address',
                                                'id' => 'subject',
                                                'attributes' => 'required',
                                            ])

                                        </div>
                                    </div>
                                </div>

                                <div class="submit-btn">
                                    <button id="submit" class="rr-primary-btn" type="submit">ارسال پیام</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">

                    <div class="contact-content">

                        <div class="contact-img">
                            <img src="{{ asset('images/site/contact-img.png') }}" alt="">
                        </div>

                        <div class="contact-info-box">
                            <h3 class="title">{{ $siteTitle }}</h3>
                            <ul>
                                <li>نشانی : {{ $siteAddress }}</li>
                                <li>شماره تماس : <a href="tel:+{{ $siteTel }}">{{ $siteTel }}</a></li>
                                <li>ایمیل : <a href="mailto:{{ $siteEmail }}">{{ $siteEmail }}</a></li>
                            </ul>
                        </div>

                        <div class="contact-info-box">
                            <h3 class="title">ساعت کاری</h3>
                            <ul>
                                <li>{{ $siteWorkingHour }}</li>
                            </ul>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>

    <div class="map-wrapper pb-50">
        <div class="container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8826.923787362664!2d-118.27754354757262!3d34.03471770929568!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c75ddc27da13%3A0xe22fdf6f254608f4!2sLos%20Angeles%2C%20California%2C%20Hoa%20K%E1%BB%B3!5e0!3m2!1svi!2s!4v1566525118697!5m2!1svi!2s"
                width="100%" height="600" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
    </div>

</di>
