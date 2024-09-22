<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = auth()->user()->cart()->with('product')->get();
        
        return view('cart.index', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $request->product_id
            ],
            ['quantity' => $request->quantity]
        );

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }

    public function remove(Request $request, Cart $cart)
    {
        $id = $request->id;
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }

    public function update(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // dd($request->all());
        // Cập nhật số lượng sản phẩm trong cơ sở dữ liệu
        $cart = Cart::where('id', $request->id)->first();
        // dd($cart);
        if ($cart) {
            $cart->quantity = $request->input('quantity');
            $cart->save();
        }
        
        return redirect()->route('cart.index')->with('success', 'Cập nhật số lượng thành công!');
    }

    // public function remove($id)
    // {
    //     // Lấy giỏ hàng từ session
    //     $cart = session('cart', []);

    //     // Xóa sản phẩm khỏi giỏ hàng
    //     if (isset($cart[$id])) {
    //         unset($cart[$id]);
    //     }

    //     // Lưu lại giỏ hàng vào session
    //     session(['cart' => $cart]);

    //     return redirect()->route('cart.index')->with('success', 'Xóa sản phẩm thành công!');
    // }
}
