@section('styles')
@endsection


<div>

    @include('custom-components.site.hero-section')

    @include('custom-components.site.discount-section')


    @foreach($collections as $collection)

        @if($collection->type == \App\Enums\CollectionType::Category)
            @include('custom-components.site.category-section', [
                'title' => $collection->title,
                'items' => $collection->categoryCollection,
                'sampleProductImageUrl' => $sampleProductImageUrl,
            ])
        @endif

        @if($collection->type == \App\Enums\CollectionType::Product)
            @include('custom-components.site.fashion-section' , ['title' => $collection->title])
        @endif

    @endforeach



    @include('custom-components.site.collect-section')

    @include('custom-components.site.cta-section')

    @include('custom-components.site.sponsor-section')

    @include('custom-components.site.deal-section')

    @include('custom-components.site.blog-section')

</div>


@section('scripts')
@endsection
