<div id="{{ $id }}" class="carousel slide" data-ride="carousel" data-touch="false">

    <ol class="carousel-indicators">
        @foreach ($galleryImages as $galleryImage)
            <li data-target="#carousel-example-generic" data-slide-to="{{ $galleryImage->id ?? '' }}" @if($loop->first) class="active" @endif>
            </li>
        @endforeach
    </ol>

    <div class="carousel-inner" role="listbox">

        @forelse ($galleryImages as $galleryImage)

            <div class="carousel-item @if($loop->first) active @endif">
                <img class="img-fluid"
                     src="{{
                                                                    is_object($galleryImage) && method_exists($galleryImage, 'temporaryUrl')
                                                                    ? $galleryImage->temporaryUrl()
                                                                    : asset($galleryImage->url)
                                                                 }}"
                     alt="gallery-image"/>
            </div>
        @empty
            <div class="carousel-item active">
                <img class="img-fluid" src="{{ asset($sampleProductImageUrl) }}" alt="default-image">
            </div>
        @endforelse

    </div>

    <a class="carousel-control-prev" href="#{{ $id }}" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">قبلی</span>
    </a>
    <a class="carousel-control-next" href="#{{ $id }}" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">بعدی</span>
    </a>
</div>
