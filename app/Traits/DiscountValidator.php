<?php

namespace App\Traits;

use App\Models\DiscountCode;
use Auth;
use Carbon\Carbon;

trait DiscountValidator
{
    public function checkCode(string $code, int $cartTotal): array
    {
        if (!Auth::check()) {
            return [
                'status' => false,
                'error' => 'برای استفاده از کد تخفیف باید وارد حساب کاربری شوید.',
            ];
        }

        $discount = DiscountCode::isActive()->where('code', $code)->first();

        if (!$discount) {
            return [
                'status' => false,
                'error' => 'کد تخفیف  '.$code.' نامعتبر است',
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
                'error' => 'سبد خرید کمتر از '.number_format($discount->min_order_amount).' تومان است',
            ];
        }

        if ($discount->expires_at < Carbon::now()) {
            return [
                'status' => false,
                'error' => 'کد تخفیف منقضی شده است',
            ];
        }

        if (auth()->user()->discountCodes()->where('discount_code_id', $discount->id)->exists()) {
            return [
                'status' => false,
                'error' => 'شما قبلاً از این کد تخفیف استفاده کرده‌اید',
            ];
        }

        return [
            'status' => true,
            'discount' => $discount,
            'amount' => $discount->calculateDiscount($cartTotal)
        ];
    }
}
