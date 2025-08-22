<?php

namespace App\Traits;

use App\Models\DiscountCode;
use Carbon\Carbon;

trait DiscountValidator
{
    public function checkCode(string $code, int $cartTotal): array
    {
        $discount = DiscountCode::whereCode($code)
            ->isActive()
            ->first();

        if (!$discount) {
            return [
                'status' => false,
                'error' => 'کد تخفیف نامعتبر است',
            ];
        }

        if ($discount->used_count >= $discount->usage_limit) {
            return [
                'status' => false,
                'error' => 'تعداد دفعات استفاده از این کد تخفیف به پایان رسیده است',
            ];
        }

        if ($discount->min_order_amount >= $cartTotal) {
            return [
                'status' => false,
                'error' => 'سبد خرید کمتر از ' . number_format($discount->min_order_amount) . ' تومان است',
            ];
        }

        if ($discount->expires_at < Carbon::now()) {
            return [
                'status' => false,
                'error' => 'کد تخفیف منقضی شده است',
            ];
        }

        return [
            'status' => true,
            'discount' => $discount,
            'amount' => $discount->calculateDiscount($cartTotal)
        ];
    }
}
