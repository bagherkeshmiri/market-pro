<div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="{{ $modalId }}-label"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $modalId }}Label">{{ $modalTitle }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="بستن">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div style="display: flex; flex-direction: column; gap: 8px; color: white; font-size: 14px;">

                    <div
                        style="display: flex; font-weight: bold; background-color: #272E48; padding: 8px; border: 1px solid #555;">
                        <div style="flex: 1;">نام کالا</div>
                        <div style="flex: 1;">تعداد</div>
                        <div style="flex: 1;">قیمت اولیه</div>
                        <div style="flex: 1;">قیمت نهایی</div>
                    </div>

                    @forelse ($items as $item)
                        <div style="display: flex; background-color: #272E48; padding: 8px; border: 1px solid #444;">
                            <div style="flex: 1;">{{ $item->product->name ?? '—' }}</div>
                            <div style="flex: 1;">{{ $item->qty ?? 0 }}</div>
                            <div style="flex: 1;">{{ number_format($item->unit_price) }} تومان</div>
                            <div style="flex: 1;">{{ number_format($item->final_price) }} تومان</div>
                        </div>
                    @empty
                        <div style="padding: 12px; background-color: #111; border: 1px solid #444; text-align: center;">
                            موردی یافت نشد.
                        </div>
                    @endforelse

                </div>

            </div>
        </div>
    </div>
</div>
