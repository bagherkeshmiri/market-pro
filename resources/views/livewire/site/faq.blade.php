<div>

    <div class="faq-section pt-50 pb-50">
        <div class="container rtl">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="faq-content">
                        <div class="accordion" id="accordionExampleTwo">

                            @foreach($faqs as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="true" aria-controls="collapse{{ $faq->id }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse @if($loop->first) show @endif " aria-labelledby="headingTwo" data-bs-parent="#accordionExampleTwo">
                                        <div class="accordion-body">
                                            {!! $faq->answer !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
