@section('styles')
@endsection


<div>

        @include('custom-components.site.hero-section')

        @include('custom-components.site.discount-section')

    @foreach($collections as $collection)

{{--        @if($collection->type == \App\Enums\CollectionType::Category)--}}
{{--            <livewire:site.category-section--}}
{{--                :title="$collection->title"--}}
{{--                :items="$collection->categoryCollection"--}}
{{--                :sample-product-image-url="$sampleProductImageUrl"--}}
{{--                wire:key="category-section-{{ $collection->id }}"--}}
{{--            />--}}
{{--        @endif--}}

        @if($collection->type == \App\Enums\CollectionType::Product)
            <livewire:site.fashion-section
                :title="$collection->title"
                :items="$collection->productCollection"
                :sample-product-image-url="$sampleProductImageUrl"
                wire:key="fashion-section-{{ $collection->id }}"
            />
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
