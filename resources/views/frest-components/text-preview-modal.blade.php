<div class="modal fade @isset($classes)  {{ $classes }} @endisset" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="{{ $modalId . 'Title' }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="{{ $modalId . 'Title' }}">{{ $modalTitle }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body text-center">
               <p>
                   {{ $content }}
               </p>
            </div>
        </div>
    </div>
</div>
