<div>
    <section class="ftco-section" style="padding: 0 !important;">
        <div class="container">
            @include('custom-components.site.spacial-products',['title' =>'محصولات ' . $category->name ,'products' => $products , 'sampleProductImageUrl' => $sampleProductImageUrl])

            <div class="row mb-5">
                <div class="col text-center">
                    <div class="block-27">
                        {{ $products->links('custom-components.site.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
