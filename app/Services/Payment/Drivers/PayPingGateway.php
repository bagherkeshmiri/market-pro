<?php

namespace App\Services\Payment\Drivers;

use App\Services\Payment\Contracts\GatewayInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Str;

class PayPingGateway implements GatewayInterface
{

    protected mixed $token;
    protected string $endpointUrl;
    protected array $headers;

    public function __construct()
    {
        $this->token = config('payment.payping_token');
        $this->endpointUrl = 'https://api.payping.ir/new/v2/pay';
        $this->headers = [
            'accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'bearer ' . $this->token,
        ];
    }


    /**
     * @throws ConnectionException
     */
    private function redirectToGate(string $code): void
    {
        $response = Http::withHeaders($this->headers)
            ->post($this->endpointUrl . '/gotoipg/' . $code);

        $data = $response->json();
    }

    /**
     * @throws ConnectionException
     */
    public function request(
        int $amount,
        string $callbackUrl,
        string $orderNumber,
        string $mobile,
        string $email,
    ): array {
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'bearer ' . $this->token,
        ])
            ->post($this->endpointUrl, [
                'amount' => $amount,
                'payerIdentity' => empty($mobile) ? $email : $mobile,
                'description' => 'order ' . $orderNumber,
                'returnUrl' => $callbackUrl,
                'clientRefId' => $orderNumber,
            ]);

        $data = $response->json();

        if (!empty($data['data']['code'])) {
            $this->redirectToGate($data['data']['code']);
        }

        return ['status' => false, 'message' => $data['errors']['message'] ?? 'خطای نامشخص'];

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
