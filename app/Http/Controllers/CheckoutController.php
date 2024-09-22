<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart; // Assuming Cart model is defined in App\Models namespace

class CheckoutController extends Controller
{
    public function index()
    {
        // Lấy thông tin giỏ hàng từ cơ sở dữ liệu
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $cartTotal = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity; // Giả sử bạn có quan hệ với model Product
        });
        // dd($cartItems, $cartTotal);
        // Trả về view thanh toán với dữ liệu giỏ hàng
        return view('checkout.index', compact('cartItems', 'cartTotal'));
    }
}
