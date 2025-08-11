<?php

namespace App\Services\Payment\Contracts;

interface GatewayInterface
{
    public function request(
        int $amount,
        string $callbackUrl,
        string $orderNumber,
        string $mobile,
        string $email,
    );

    public function verify(array $params);
}
