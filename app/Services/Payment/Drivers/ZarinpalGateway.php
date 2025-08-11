<?php

namespace App\Services\Payment\Drivers;

use App\Services\Payment\Contracts\GatewayInterface;
use Illuminate\Support\Facades\Http;
use Str;

class ZarinpalGateway implements GatewayInterface
{
    protected mixed $merchantId;
    protected string $endpointUrl;

    public function __construct()
    {
        $isLocal = app()->isLocal();

        $this->merchantId = $isLocal ? (string)Str::uuid() : config('payment.zarinpal_token');
        $this->endpointUrl = $isLocal
            ? 'https://sandbox.zarinpal.com/pg/v4/payment/request.json'
            : 'https://payment.zarinpal.com/pg/v4/payment/request.json';
    }

    public function request(
        int $amount,
        string $callbackUrl,
        string $orderNumber,
        string $mobile,
        string $email,
    ): array {
        $response = Http::post($this->endpointUrl, [
            'merchant_id' => $this->merchantId,
            'amount' => $amount,
            'currency' => 'IRT',
            'callback_url' => $callbackUrl,
            'description' => "order #$orderNumber",
            'metadata' => [
                'mobile' => empty($mobile) ? '09150000000' : $mobile,
                'email' => $email,
                'order_id' => $orderNumber,
            ],
        ]);

        $data = $response->json();

        if ($data['data']['code'] === 100) {
            return [
                'status' => true,
                'gateway_url' => "https://www.zarinpal.com/pg/StartPay/{$data['data']['authority']}",
                'authority' => $data['data']['authority'],
            ];
        }

        return ['status' => false, 'message' => $data['errors']['message'] ?? 'خطای نامشخص'];
    }

    public function verify(array $params): array
    {
        $authority = $params['Authority'] ?? null;

        $response = Http::post('https://api.zarinpal.com/pg/v4/payment/verify.json', [
            'merchant_id' => $this->merchantId,
            'amount' => $params['amount'],
            'authority' => $authority,
        ]);

        $data = $response->json();

        if ($data['data']['code'] === 100) {
            return ['status' => true, 'ref_id' => $data['data']['ref_id']];
        }

        return ['status' => false, 'message' => $data['errors']['message'] ?? 'تراکنش ناموفق'];
    }
}
