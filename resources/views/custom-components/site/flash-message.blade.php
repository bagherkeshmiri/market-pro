@if (!is_null(session('success')))
    <div class="alert alert-success mb-3 text-end d-flex align-items-center gap-2" dir="rtl">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <span> {{ session('success') }}</span>
    </div>
@endif


@if (!is_null(session('error')))
    <div class="alert alert-danger mb-3 text-end d-flex align-items-center gap-2" dir="rtl">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <span> {{ session('error') }}</span>
    </div>
@endif


@if (!is_null(session('warning')))
    <div class="alert alert-warning mb-3 text-end d-flex align-items-center gap-2" dir="rtl">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <span> {{ session('warning') }}</span>
    </div>
@endif


@if (!is_null(session('info')))
    <div class="alert alert-info mb-3 text-end d-flex align-items-center gap-2" dir="rtl">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <span> {{ session('info') }}</span>
    </div>
@endif
