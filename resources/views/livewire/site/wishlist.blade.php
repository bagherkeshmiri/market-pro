<div>
    <section class="cart-section pt-50 pb-50">
        <div class="container rtl">
            <div class="table-content cart-table table-2">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th class="product-remove"></th>
                        <th class="cart-product-name text-center">نام محصول</th>
                        <th class="product-price"> قیمت</th>
                        <th class="product-quantity">وضعیت موجودی</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($wishlist as $key => $value)
                        <tr>
                            <td class="product-remove">
                                <button wire:click="removeProductFromWishlist({{ $key }})">
                                    <i class="fa-sharp fa-regular fa-trash" style="color:#FF5B5C !important;"></i>
                                </button>
                            </td>
                            <td class="product-thumbnail">
                                <a href="{{ route('site.single-product',['product' => $key]) }}">
                                    <img src="{{ $value['image'] ? asset($value['image']) : asset($sampleImageUrl) }}" alt="wishlist">
                                </a>
                                <div class="product-thumbnail">
                                    <span class="category">{{ $value['category'] }}</span>
                                    <h4 class="title">{{ $value['name'] }}</h4>
                                </div>
                            </td>
                            <td class="product-price"><span class="amount">{{ number_format($value['unit_price']) }} تومان </span></td>
                            <td class="product-quantity">
                                @if($value['status'] == \App\Enums\ProductStatus::Exist)
                                    <span> @lang('global.exist')</span>
                                @else
                                    <span class="text-danger"> @lang('global.not_exist')</span>
                                @endif
                            </td>
                            <td class="product-subtotal">
                                <button class="rr-primary-btn" wire:click="addProductToCart({{ $value['id'] }})">اضافه به سبد خرید</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;">لیست علاقه مندی شما خالی است</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>


@section('scripts')
    <script>
        window.addEventListener('product-added-to-cart', event => {
            Swal.fire({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 10000,
                background: '#F0FFF4',
                color: '#38A169',
                title: `${event.detail.name} به سبد خرید اضافه شد`,
                customClass: {title: 'swal2-title-rtl'},
                timerProgressBar: true,
            });
        });

        window.addEventListener('product-already-in-cart', event => {
            Swal.fire({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 10000,
                background: '#FEEBC8',
                color: '#D69E2E',
                title: `${event.detail.name} قبلاً به سبد خرید اضافه شده است`,
                customClass: {title: 'swal2-title-rtl'},
                timerProgressBar: true,
            });
        });
    </script>
@endsection
