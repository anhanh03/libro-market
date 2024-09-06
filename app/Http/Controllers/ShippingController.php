<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'tracking_number' => 'required|string',
            'status' => 'required|in:processing,shipped,delivered',
            'estimated_delivery_date' => 'required|date'
        ]);

        $shipping = $order->shipping ?? new Shipping();
        $shipping->fill($request->all());
        $shipping->order_id = $order->id;
        $shipping->save();

        if ($request->status == 'delivered') {
            $order->update(['status' => 'completed']);
        }

        return redirect()->route('seller.orders.show', $order)->with('success', 'Thông tin vận chuyển đã được cập nhật');
    }
}
