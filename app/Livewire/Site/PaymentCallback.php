<?php

namespace App\Livewire\Site;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Livewire\BaseComponents\SiteComponent;
use App\Models\Gate;
use App\Models\Payment;
use App\Services\Payment\GatewayFactory;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Log;

class PaymentCallback extends SiteComponent
{
    public string $paymentResultString;
    private ?string $authority = null;
    private ?string $status = null;

    /**
     * @throws Exception
     */
    public function mount(Request $request): void
    {
        $this->status = $request->input('Status');
        $this->authority = $request->input('Authority');

        $this->paymentResultString = __('payment.technical_error');

        if ($this->status === 'OK' && $this->authority) {
            $this->processPayment();
        } else {
            $this->paymentResultString = __('payment.canceled');
        }
    }

    /**
     * @throws Exception
     */
    private function processPayment(): void
    {
        $payment = Payment::whereAuthority($this->authority)->first();

        if (!$payment) {
            $this->paymentResultString = __('payment.not_found');
            return;
        }

        if ($payment->status === PaymentStatus::Success) {
            $this->paymentResultString = __('payment.processed');
            return;
        }

        $gateway = GatewayFactory::make(Gate::find($payment->gate_id));

        try {
            $response = $gateway->verify([
                'Authority' => $this->authority,
                'amount' => (int)$payment->amount,
            ]);
        } catch (Exception $e) {
            Log::info('payment callback error :' . $e->getMessage());
            $this->paymentResultString = __('payment.technical_error');
            return;
        }

        if (!empty($response['status'])) {
            $payment->update([
                'ref_id' => $response['ref_id'] ?? null,
                'status' => PaymentStatus::Success,
                'paid_at' => Carbon::now(),
            ]);

            $payment->order?->update([
                'status' => OrderStatus::Paid,
            ]);

            $this->paymentResultString = __('payment.success', [
                'ref_id' => $response['ref_id'] ?? '-',
            ]);
        } else {
            $this->paymentResultString = __('payment.bank_error');
        }
    }


    /**
     * @throws Exception
     */
    public function render(): View
    {
        $pageTitle = 'نتیجه پرداخت ';

        return $this->renderView(
            'livewire.site.payment-callback',
            $pageTitle
        );
    }
}
