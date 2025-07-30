<?php

namespace App\Services\Payment\Contracts;

interface GatewayInterface
{
    public function request(int $amount, string $callbackUrl, string $orderId): array;

    public function verify(array $params): array;
}
