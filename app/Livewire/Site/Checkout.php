<?php

namespace App\Livewire\Site;

use App\Enums\OrderStatus;
use App\Livewire\BaseComponents\SiteComponent;
use App\Models\City;
use App\Models\GateOrg;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Province;
use App\Services\Payment\GatewayFactory;
use DB;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;

class Checkout extends SiteComponent
{
    public $cart = [];
    public $cartTotal = 0;
    public $tax = 0;
    public $shipping = 20000;
    public $discount = 50000;
    public $freeShipping = 2000000;
    public $gateOrg;
    public $user;
    public $email;
    public $fullName;
    public $postalCode;
    public $address;
    public $phone;
    public $orderMessage;
    public $provinces;
    public $selectedProvince = null;
    public $selectedProvinceName = null;
    public $cities = [];
    public $selectedCity = null;
    public $selectedCityName = null;

    protected $listeners = ['provinceSelected', 'citySelected'];

    public function mount(): RedirectResponse|Redirector|null
    {
        $this->cart = Session::get('cart', []);
        if (empty($this->cart)) {
            $this->discount = 0;
            $this->shipping = 0;
            return redirect()->route('site.cart');
        }
        $this->calculateCartTotal();
        $this->calculateTax($this->cartTotal);

        $this->user = auth('web')->user();
        if ($this->user) {
            $this->fullName = $this->user->name;
            $this->email = $this->user->email;
        }

        $this->provinces = Province::pluck('name', 'id')->toArray();

        $this->gateOrg = GateOrg::withoutTrashed()->isActive()->isDefault()->first();

        return null;
    }

    public function calculateCartTotal(): void
    {
        $this->cartTotal = collect($this->cart)->sum('final_price');
    }

    protected function calculateTax(int $amount): int
    {
        $this->tax = round($amount * 0.09);
        return $this->tax;
    }

    public function getTotalPayableProperty(): int
    {
        return $this->cartTotal + $this->tax + $this->shipping - $this->discount;
    }

    public function render(): View
    {
        $pageTitle = 'تسویه حساب';
        return $this->renderView(
            'livewire.site.checkout',
            $pageTitle
        );
    }

    public function provinceSelected($id, $name): void
    {
        $this->selectedProvince = $id;
        $this->selectedProvinceName = $name;
        $this->cities = City::whereProvinceId($id)->pluck('name', 'id')->toArray();
        $this->selectedCity = null;
    }

    public function citySelected($id, $name): void
    {
        $this->selectedCity = $id;
        $this->selectedCityName = $name;
    }

    /**
     * @throws Throwable
     */
    public function pay()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'fullName' => 'required|string|max:255',
            'postalCode' => 'required|digits:10',
            'phone' => 'required|digits_between:8,15',
            'orderMessage' => 'nullable|string|max:500',
        ]);

//        DB::beginTransaction();
        try {
            $expiredOrderIds = $this->user->orders()
                ->where('status', OrderStatus::Pending)
                ->whereNotBetween('created_at', [
                    today()->startOfDay()->toDateTimeString(),
                    today()->endOfDay()->toDateTimeString()
                ])
                ->pluck('id')
                ->toArray();


            if (!empty($expiredOrderIds)) {
                OrderItem::whereIn('order_id', $expiredOrderIds)->delete();
                Payment::whereIn('order_id', $expiredOrderIds)->delete();
                Order::whereIn('id', $expiredOrderIds)->delete();
            }


            $existingOrder = $this->user->orders()
                ->where('status', OrderStatus::Pending)
                ->whereBetween(
                    'created_at',
                    [today()->startOfDay()->toDateTimeString(), today()->endOfDay()->toDateTimeString()]
                )
                ->first();


            dd(
                $existingOrder,
//                $this->user->orders
            );


            if ($existingOrder) {
                session()->forget('processing_order');

                return;
            }

            if (is_null($existingOrder)) {
                $order = $this->user->orders()->create([
                    'subtotal' => $this->cartTotal,
                    'discount' => $this->discount,
                    'tax' => $this->tax,
                    'shipping_fee' => $this->shipping,
                    'total' => $this->totalPayable,
                ]);

                foreach ($this->cart as $cart) {
                    $order->orderItems()->create([
                        'product_id' => $cart['id'],
                        'qty' => $cart['qty'],
                        'unit_price' => $cart['unit_price'],
                        'final_price' => $cart['final_price'],
                    ]);
                }

                $payment = $order->payments()->create([
                    'user_id' => auth()->id(),
                    'gate_id' => $this->gateOrg->gate_id,
                    'gate_org_id' => $this->gateOrg->id,
                    'amount' => $this->totalPayable,
                ]);
            }


            $gateway = GatewayFactory::make();

            $result = $gateway->request(
                $this->totalPayable,
                'https://83ece52cbdd5.ngrok-free.app/verify',
                $order->order_number,
                $this->user->mobile ?? '',
                $this->user->email ?? '',
            );

            if ($result['status']) {
                $payment->update([
                    'authority' => $result['authority']
                ]);

//                DB::commit();

                redirect($result['gateway_url']);
            }
        } catch (Exception) {
//            DB::rollBack();
            session()->flash('error', __('global.error_message'));
        } finally {
            session()->forget('processing_order');
        }
    }
}
