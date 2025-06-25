<div>
    <section class="ftco-section" style="padding: 0 !important;">
        <div class="container">
            @include('custom-components.site.spacial-products',['title' =>'محصولات ' . $category->name ,'products' => $products , 'sampleProductImageUrl' => $sampleProductImageUrl])

            <div class="row mb-5">
                <div class="col text-center">
                    <div class="block-27">
                        <ul>
                            <li><a href="#">&lt;</a></li>
                            <li class="active"><span>1</span></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&gt;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
