<?php

namespace App\Livewire\Site;

use App\Enums\OrderStatus;
use App\Livewire\BaseComponents\SiteComponent;
use App\Models\City;
use App\Models\GateOrg;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Province;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;

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

    public function pay()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'fullName' => 'required|string|max:255',
            'postalCode' => 'required|digits:10',
            'phone' => 'required|digits_between:8,15',
            'orderMessage' => 'nullable|string|max:500',
        ]);

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

        $order->payments()->create([
            'gate_id' => $this->gateOrg->gate_id,
            'gate_org_id' => $this->gateOrg->id,
            'amount' => $this->totalPayable,
        ]);
    }
}
