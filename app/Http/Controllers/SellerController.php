<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Product;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function dashboard()
    {
        $seller = auth()->user()->seller;
        $totalProducts = $seller->products()->count();
        $totalOrders = $seller->orders()->count();
        $recentOrders = $seller->orders()->latest()->take(5)->get();
        
        return view('seller.dashboard', compact('totalProducts', 'totalOrders', 'recentOrders'));
    }

    public function products()
    {
        $products = auth()->user()->seller->products()->paginate(10);
        return view('seller.products.index', compact('products'));
    }

    public function createProduct()
    {
        return view('seller.products.create');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);

        $product = auth()->user()->seller->products()->create($request->all());

        return redirect()->route('seller.products')->with('success', 'Sản phẩm đã được tạo thành công');
    }

    public function orders()
    {
        $orders = auth()->user()->seller->orders()->latest()->paginate(10);
        return view('seller.orders.index', compact('orders'));
    }
}
