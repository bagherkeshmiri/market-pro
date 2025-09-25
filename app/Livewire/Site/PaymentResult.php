<?php

namespace App\Livewire\Site;

use App\Enums\PaymentStatus;
use App\Livewire\BaseComponents\SiteComponent;
use Illuminate\View\View;
use Session;

class PaymentResult extends SiteComponent
{
    public PaymentStatus $paymentStatus;
    public string $paymentResultString;
    public $cart = [];

    public function mount(): void
    {
        $data = Session::get('payment_data');

        $this->paymentStatus = $data['status'] ?? PaymentStatus::UnSuccess;
        $this->paymentResultString = $data['message'] ?? __('payment.technical_error');
    }

    public function render(): View
    {
        return $this->renderView(
            'livewire.site.payment-result',
            'نتیجه پرداخت'
        );
    }
}
