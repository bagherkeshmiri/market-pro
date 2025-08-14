<?php

namespace App\Services\Payment\Drivers;

use App\Models\Gate;
use App\Services\Payment\Contracts\GatewayInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Str;

class ZarinpalGateway implements GatewayInterface
{
    protected string $token;
    protected string $requestUrl;
    protected string $verifyUrl;
    protected string $startPayUrl;

    public function __construct(Gate $gateway)
    {
        $isLocal = app()->isLocal();

        if ($isLocal) {
            $this->token = '8aaaad80-f396-4cef-baaf-219b3f9c4853';
            $this->requestUrl = 'https://sandbox.zarinpal.com/pg/v4/payment/request.json';
            $this->verifyUrl = 'https://sandbox.zarinpal.com/pg/v4/payment/verify.json';
            $this->startPayUrl = 'https://sandbox.zarinpal.com/pg/StartPay/';
        } else {
            $this->token = $gateway->token;
            $this->requestUrl = 'https://payment.zarinpal.com/pg/v4/payment/request.json';
            $this->verifyUrl = 'https://payment.zarinpal.com/pg/v4/payment/verify.json';
            $this->startPayUrl = 'https://www.zarinpal.com/pg/StartPay/';
        }
    }

    public function request(
        int $amount,
        string $callbackUrl,
        string $orderNumber,
        string $mobile,
        string $email,
    ): array {
        $response = Http::post($this->requestUrl, [
            'merchant_id' => $this->token,
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

        if (isset($data['data']['code']) && $data['data']['code'] === 100) {
            return [
                'status' => true,
                'gateway_url' => $this->startPayUrl . $data['data']['authority'],
                'authority' => $data['data']['authority'],
            ];
        }

        return [
            'status' => false,
            'message' => $data['errors']['message'] ?? 'خطای نامشخص از زرین‌پال'
        ];
    }

    public function verify(array $params): array
    {
        $authority = $params['Authority'] ?? null;

        if (!$authority) {
            Log::info(' zarinpal payment error  : authority is null');
            return ['status' => false, 'message' => 'خطا در تراکنش'];
        }

        $response = Http::post($this->verifyUrl, [
            'merchant_id' => $this->token,
            'amount' => $params['amount'],
            'authority' => $authority,
        ]);

        $data = $response->json();

        if (isset($data['data']['code']) && $data['data']['code'] === 100 || $data['data']['code'] === 101) {
            return ['status' => true, 'ref_id' => $data['data']['ref_id']];
        }

        if (isset($data['data']['code']) && $data['data']['code'] !== 100 || $data['data']['code'] !== 101) {
            Log::info('zarinpal payment error code : ' . $data['data']['code'] . ' - ' . ' authority' . $authority);
        }

        return [
            'status' => false,
            'message' => 'تراکنش ناموفق'
        ];
    }
}
