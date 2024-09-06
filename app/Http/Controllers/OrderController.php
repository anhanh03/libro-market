<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required',
            'payment_method' => 'required'
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $this->calculateTotalAmount(),
            'status' => 'pending',
            'shipping_address' => $request->shipping_address,
            'payment_method' => $request->payment_method
        ]);

        // Chuyển sản phẩm từ giỏ hàng sang đơn hàng
        $this->moveCartItemsToOrder($order);

        return redirect()->route('orders.show', $order)->with('success', 'Đơn hàng đã được tạo thành công');
    }

    private function calculateTotalAmount()
    {
        // Logic tính tổng giá trị đơn hàng
    }

    private function moveCartItemsToOrder($order)
    {
        // Logic chuyển sản phẩm từ giỏ hàng sang đơn hàng
    }
}
