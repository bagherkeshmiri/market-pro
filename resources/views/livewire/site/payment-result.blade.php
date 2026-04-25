<div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 text-center p-4">

    <img
        src="{{ asset($this->paymentStatus == \App\Enums\PaymentStatus::Success ? 'images/success.png' : 'images/unsuccess.png') }}"
        alt="{{ $this->paymentStatus == \App\Enums\PaymentStatus::Success ? 'success-payment' : 'unsuccess-payment' }}"
        style="display: block; width: 12%; margin: 32px auto 40px;">

    <p class="text-dark" style="font-size: 1.4rem; direction: rtl ;" >
        {{ $paymentResultString }}
    </p>
</div>
