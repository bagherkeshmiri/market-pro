@section('title','سوالات متداول کاربران')

@section('styles')
@endsection


<div class="d-flex flex-column mx-auto wrapper">
    <div class="d-flex flex-row justify-content-between">
        <h4 style="margin-bottom: 20px;">پشتیبانی</h4>
    </div>
    <div id="accordion">
        @foreach($articles as $article)
            @foreach($article->articlesUserSupport as $item)
                @include('frest-components.accordion.simple-accordion',['id' => $item->id , 'title' => $item->title , 'content' => $item->content , 'dataParent' => 'accordion' , 'firstId' => $firstId])
            @endforeach
        @endforeach

    </div>

</div>

@section('scripts')
@endsection
