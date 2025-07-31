<?php

namespace App\Services\Payment;

use App\Models\GateOrg;
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
        $gatewayOrg = GateOrg::withoutTrashed()
            ->isActive()
            ->isDefault()
            ->with('gate')
            ->firstOrFail();

        $name = Str::lower($gatewayOrg->gate->name);

        return match ($name) {
            'zarinpal' => new ZarinpalGateway(['app_key' => $gatewayOrg->app_key]),
            'idpay' => new IdpayGateway(['app_key' => $gatewayOrg->app_key]),
            'payping' => new PayPingGateway(['app_key' => $gatewayOrg->app_key]),
            default => throw new Exception('درگاه ناشناخته است'),
        };
    }
}

