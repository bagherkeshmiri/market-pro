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

    public function mount(): void
    {
        $data = Session::get('payment_data');
        $this->paymentStatus = $data['status'];
        $this->paymentResultString = $data['message'];
    }

    public function render(): View
    {
        $pageTitle = 'نتیجه پرداخت';

        return $this->renderView(
            'livewire.site.payment-result',
            $pageTitle
        );
    }
}
