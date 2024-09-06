<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function process(Order $order)
    {
        // Giả sử bạn đang sử dụng một cổng thanh toán
        // Trong thực tế, bạn sẽ tích hợp với API của cổng thanh toán ở đây
        $paymentSuccessful = true;

        if ($paymentSuccessful) {
            $payment = new Payment([
                'order_id' => $order->id,
                'amount' => $order->total_amount,
                'payment_method' => 'credit_card', // hoặc phương thức thanh toán được chọn
                'transaction_id' => 'TRANS_' . uniqid(),
                'status' => 'completed'
            ]);
            $payment->save();

            $order->update(['status' => 'paid']);

            return redirect()->route('orders.show', $order)->with('success', 'Thanh toán thành công');
        } else {
            return redirect()->route('orders.show', $order)->with('error', 'Thanh toán thất bại. Vui lòng thử lại');
        }
    }
}
