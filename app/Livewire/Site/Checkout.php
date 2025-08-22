<?php

namespace App\Livewire\Site;

use App\Enums\OrderStatus;
use App\Livewire\BaseComponents\SiteComponent;
use App\Models\City;
use App\Models\Gate;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Province;
use App\Models\UserAddress;
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
    public $discount = 0;
    public $freeShipping = 2000000;
    public $gate;
    public $user;
    public $email;
    public $fullName;
    public $postalCode;
    public $address;
    public $orderMessage;
    public $provinces;
    public $cities = [];
    public $userAddresses;
    public $selectedProvince;
    public $selectedCity;
    public $selectedAddressId;
    public $createdUserAddress;
    public $cartDiscountDetails = [];


    public function mount(): RedirectResponse|Redirector|null
    {
        $this->cart = Session::get('cart', []);
        $this->cartDiscountDetails = Session::get('cart_discount_details', []);
        $this->discount = $this->cartDiscountDetails['discount_amount'];

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

        $this->provinces = Province::orderBy('id')->pluck('name', 'id')->toArray();

        $this->gate = Gate::withoutTrashed()->isActive()->isDefault()->first();

        $this->userAddresses = $this->user->addresses;

        if ($this->selectedProvince) {
            $this->provinceSelected($this->selectedProvince);
        }

        return null;
    }

    public function provinceSelected($provinceId): void
    {
        $this->selectedProvince = $provinceId;
        $this->cities = City::where('province_id', $provinceId)->pluck('name', 'id')->toArray();
    }

    public function fillAddressFromSaved(): void
    {
        $selectedAddress = UserAddress::find($this->selectedAddressId);

        if (!is_null($selectedAddress)) {
            $this->selectedProvince = $selectedAddress->province_id;
            $this->cities = City::where('province_id', $selectedAddress->province_id)->pluck('name', 'id')->toArray();
            $this->selectedCity = (string)$selectedAddress->city_id;
            $this->address = $selectedAddress->address;
            $this->postalCode = $selectedAddress->postal_code;
        }
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

    /**
     * @throws Throwable
     */
    public function pay(): void
    {
        if (is_null($this->gate)) {
            $this->js(
                "window.dispatchEvent(new CustomEvent('error', { detail: { content: 'امکان پرداخت از طریق درگاه وجود ندارد. لطفا بعدا دوباره تلاش کنید' } }));"
            );
            return;
        }

        $this->validate([
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'fullName' => 'required|string|max:100',
            'postalCode' => 'required|digits:10',
            'orderMessage' => 'nullable|string|max:255|regex:/^[\pL\pN\s.,!?\-@#\$%\^&\*\(\)\[\]{}"\'\/\\\n\r\t]+$/u',
            'selectedProvince' => 'required|numeric',
            'selectedCity' => 'required|numeric',
            'address' => 'required|regex:/^[\pL\pN\s.,\-\/]+$/u',
        ]);

        DB::beginTransaction();
        try {
            $expiredOrderIds = $this->user->orders()
                ->where('status', OrderStatus::Pending)
                ->pluck('id')
                ->toArray();

            if (!empty($expiredOrderIds)) {
                OrderItem::whereIn('order_id', $expiredOrderIds)->delete();
                Payment::whereIn('order_id', $expiredOrderIds)->delete();
                Order::whereIn('id', $expiredOrderIds)->delete();
            }

            $order = $this->user->orders()->create([
                'subtotal' => $this->cartTotal,
                'discount' => $this->discount,
                'tax' => $this->tax,
                'shipping_fee' => $this->shipping,
                'total' => $this->totalPayable,
                'description' => $this->orderMessage,
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
                'user_id' => auth('web')->id(),
                'gate_id' => $this->gate->id,
                'amount' => $this->totalPayable,
            ]);

            $addressExists = $this->user->addresses()
                ->where('province_id', $this->selectedProvince)
                ->where('city_id', $this->selectedCity)
                ->where('postal_code', $this->postalCode)
                ->where('address', 'like', '%' . $this->address . '%')
                ->exists();

            if (!$addressExists) {
                $this->createdUserAddress = $this->user->addresses()->create([
                    'province_id' => $this->selectedProvince,
                    'city_id' => $this->selectedCity,
                    'address' => $this->address,
                    'postal_code' => $this->postalCode,
                ]);
            }

            $selectedId = (int)$this->selectedAddressId;
            $createdId = (int)$this->createdUserAddress?->id;

            if (($selectedId !== 0 && $createdId === 0) || ($selectedId === 0 && $createdId !== 0)) {
                $order->update([
                    'user_address_id' => $selectedId !== 0 ? $selectedId : $createdId
                ]);
            }

            $gateway = Gate::withoutTrashed()
                ->isActive()
                ->isDefault()
                ->firstOrFail();


            $gateway = GatewayFactory::make($gateway);

            $result = $gateway->request(
                $this->totalPayable,
                config('payment.local_payment_callback') . '/payment/callback',
                $order->order_number,
                $this->user->mobile ?? '',
                $this->user->email ?? '',
            );

            if ($result['status']) {
                $payment->update([
                    'authority' => $result['authority']
                ]);


                $this->cartDiscountDetails['discount']->incrementUsage();
                $this->cartDiscountDetails['discount']->usages()->create([
                    'user_id' => auth()->user()->id,
                ]);


                DB::commit();

                redirect($result['gateway_url']);
            }
        } catch (Exception $e) {
            DB::rollBack();
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
        } finally {
            session()->forget('processing_order');
        }
    }
}
