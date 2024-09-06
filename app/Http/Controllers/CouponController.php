<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:coupons,code'
        ]);

        $coupon = Coupon::where('code', $request->code)
                        ->where('is_active', true)
                        ->where('start_date', '<=', now())
                        ->where('end_date', '>=', now())
                        ->first();

        if (!$coupon) {
            return back()->withErrors(['code' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn']);
        }

        session(['coupon' => $coupon]);

        return back()->with('success', 'Mã giảm giá đã được áp dụng');
    }

    public function remove()
    {
        session()->forget('coupon');
        return back()->with('success', 'Mã giảm giá đã được gỡ bỏ');
    }
}
