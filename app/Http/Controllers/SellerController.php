<?php

namespace App\Http\Controllers;

use App\Models\Seller; // Đảm bảo rằng bạn đã import lớp Seller
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Import Carbon để xử lý ngày tháng

class SellerController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user(); // Lấy thông tin người dùng hiện tại
        $seller = Seller::where('user_id', $user->id)->first(); // Lấy thông tin người bán dựa trên user_id

        if (!$seller) {
            // Xử lý trường hợp không tìm thấy người bán
            return redirect()->route('home')->with('error', 'Không tìm thấy thông tin người bán.');
        }

        $totalProducts = $seller->products()->count();
        $totalOrders = $seller->orders()->count();
        $recentOrders = $seller->orders()->latest()->take(5)->get();

        // Tính toán doanh thu hàng tháng
        $monthlyRevenue = $seller->orders()
            ->where('created_at', '>=', Carbon::now()->startOfMonth())
            ->where('created_at', '<=', Carbon::now()->endOfMonth())
            ->sum('total_amount'); // Đảm bảo rằng cột 'total_amount' tồn tại

        // Tính toán số lượng đơn hàng chờ xử lý
        $pendingOrders = $seller->orders()
            ->where('status', 'pending') // Giả sử trạng thái 'pending' là trạng thái chờ xử lý
            ->count();

        // Tính toán các sản phẩm bán chạy nhất
        $topSellingProducts = $seller->products()
            ->select('products.id', 'products.name', 'products.price', 'products.description', 'products.seller_id')
            ->selectRaw('SUM(order_product.quantity) as total_sold')
            ->join('order_product', 'products.id', '=', 'order_product.product_id')
            ->join('orders', 'orders.id', '=', 'order_product.order_id')
            ->where('products.seller_id', $seller->id)
            ->groupBy('products.id', 'products.name', 'products.price', 'products.description', 'products.seller_id')
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();

        return view('seller.dashboard', compact('totalProducts', 'totalOrders', 'recentOrders', 'monthlyRevenue', 'pendingOrders', 'topSellingProducts'));
    }

    public function showRegisterForm()
    {
        $user = Auth::user();
        $seller = Seller::where('user_id', $user->id)->first();

        if ($seller) {
            // Nếu người dùng đã có thông tin đăng ký, chuyển hướng đến trang người bán
            return redirect()->route('seller.dashboard');
        }

        return view('seller.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            'business_address' => 'required|string|max:255',
            'description' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $user = Auth::user();
        $seller = Seller::where('user_id', $user->id)->first();

        if ($seller) {
            // Nếu người dùng đã có thông tin đăng ký, chuyển hướng đến trang người bán
            return redirect()->route('seller.dashboard');
        }

        $seller = new Seller();
        $seller->user_id = $user->id;
        $seller->shop_name = $request->input('shop_name');
        $seller->business_name = $request->input('business_name');
        $seller->business_address = $request->input('business_address');
        $seller->description = $request->input('description');
        $seller->address = $request->input('address');
        $seller->phone = $request->input('phone');

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $seller->logo = $logoPath;
        }

        $seller->save();

        // Cập nhật vai trò của người dùng thành role = 1
        $user->role = 1;
        $user->save();

        return redirect()->route('seller.dashboard');
    }

    // ... các phương thức khác ...
}
