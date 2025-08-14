<?php

namespace App\Services\Payment;

use App\Models\Gate;
use App\Services\Payment\Contracts\GatewayInterface;
use App\Services\Payment\Drivers\PayPingGateway;
use App\Services\Payment\Drivers\ZarinpalGateway;
use App\Services\Payment\Drivers\IdpayGateway;
use Exception;
use Illuminate\Support\Str;

class GatewayFactory
{
    /**
     * @throws Exception
     */
    public static function make(): GatewayInterface
    {
        $gateway = Gate::withoutTrashed()
            ->isActive()
            ->isDefault()
            ->firstOrFail();

        $name = Str::lower($gateway->name);

        return match ($name) {
            'zarinpal' => new ZarinpalGateway($gateway),
//            'idpay' => new IdpayGateway($gateway),
            'payping' => new PayPingGateway($gateway),
            default => throw new Exception('درگاه ناشناخته است'),
        };
    }
}

