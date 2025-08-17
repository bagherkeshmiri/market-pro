<?php

namespace App\Services\Payment\Drivers;

use App\Models\Gate;
use App\Services\Payment\Contracts\GatewayInterface;
use Illuminate\Support\Facades\Http;

class IdpayGateway implements GatewayInterface
{
    protected string $token;

    public function __construct(Gate $gateway)
    {
        $this->token = $gateway->token;
    }

    public function request(int $amount, string $callbackUrl, string $orderId): array
    {
        // TODO
//        $response = Http::post('https://api.zarinpal.com/pg/v4/payment/request.json', [
//            'merchant_id' => $this->merchantId,
//            'amount' => $amount,
//            'callback_url' => $callbackUrl,
//            'description' => "Order #$orderId",
//        ]);
//
//        $data = $response->json();
//
//        if ($data['data']['code'] === 100) {
//            return [
//                'status' => true,
//                'gateway_url' => "https://www.zarinpal.com/pg/StartPay/{$data['data']['authority']}",
//                'authority' => $data['data']['authority'],
//            ];
//        }
//
//        return ['status' => false, 'message' => $data['errors']['message'] ?? 'خطای نامشخص'];
    }

    public function verify(array $params): array
    {
        // TODO
//        $authority = $params['Authority'] ?? null;
//
//        $response = Http::post('https://api.zarinpal.com/pg/v4/payment/verify.json', [
//            'merchant_id' => $this->merchantId,
//            'amount' => $params['amount'],
//            'authority' => $authority,
//        ]);
//
//        $data = $response->json();
//
//        if ($data['data']['code'] === 100) {
//            return ['status' => true, 'ref_id' => $data['data']['ref_id']];
//        }
//
//        return ['status' => false, 'message' => $data['errors']['message'] ?? 'تراکنش ناموفق'];
    }


}
