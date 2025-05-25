@section('title','سوالات متداول')

@section('styles')
@endsection

<div class="d-flex flex-column mx-auto wrapper">
    <div class="d-flex flex-row justify-content-between">
        <h4 style="margin-bottom: 20px;">سوالات متداول</h4>
    </div>

    <div id="accordion">
        @foreach($faqs as $faq)
            @include('frest-components.accordion.simple-accordion',['id' => $faq->id , 'title' => $faq->question , 'content' => $faq->answer , 'dataParent' => 'accordion' , 'firstId' => $firstId])
        @endforeach
    </div>
</div>

@section('scripts')
@endsection
