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
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Log;

class PaymentCallback extends SiteComponent
{
    public string $paymentResultString;
    public ?string $authority = null;
    public ?string $status = null;
    public PaymentStatus $paymentStatus = PaymentStatus::UnSuccess;

    /**
     * @throws Exception
     */
    public function mount(Request $request): RedirectResponse|Redirector
    {
        $this->status = $request->input('Status');
        $this->authority = $request->input('Authority');

        $this->paymentResultString = __('payment.technical_error');

        if ($this->status === 'OK' && $this->authority) {
            $this->processPayment();
        } else {
            $this->paymentResultString = __('payment.canceled');
        }

        return redirect()->route('site.payment-result')
            ->with('payment_data', [
                'status' => $this->paymentStatus,
                'message' => $this->paymentResultString,
            ]);
    }

    /**
     * @throws Exception
     */
    private function processPayment(): void
    {
        $payment = Payment::where('authority', $this->authority)->first();

        if (!$payment) {
            $this->paymentResultString = __('payment.not_found');
            return;
        }

        if ($payment->status === PaymentStatus::Success) {
            $this->paymentResultString = __('payment.processed');
            $this->paymentStatus = PaymentStatus::Success;
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

            foreach ($payment->order->orderItems as $orderItem) {
                $product = $orderItem->product;

                if ($product->stock >= $orderItem->qty) {
                    $product->update([
                        'stock' => $product->stock - $orderItem->qty,
                    ]);
                }
            }

            $this->paymentResultString = __('payment.success', [
                'order_number' => $payment->order->order_number ?? '-',
            ]);

            $this->paymentStatus = PaymentStatus::Success;
            Session::forget('cart');
            Session::forget('cart_summary');
        } else {
            $this->paymentResultString = __('payment.bank_error');
        }
    }


    /**
     * @throws Exception
     */
    public function render(): View
    {
        $pageTitle = '';
        return $this->renderView(
            'livewire.site.payment-callback',
            $pageTitle
        );
    }
}
