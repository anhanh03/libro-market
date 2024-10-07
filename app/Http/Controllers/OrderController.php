<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Payment;
class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }
    public function sellerIndex(Request $request)
    {
        // Lấy seller_id của người dùng hiện tại
        $seller = Seller::where('user_id', auth()->user()->id)->first();

        // Kiểm tra xem seller có tồn tại không
        if (!$seller) {
            return redirect()->back()->with('error', 'Người bán không tồn tại.');
        }

        // Khởi tạo truy vấn
        $query = Order::where('seller_id', $seller->id);

        // Tìm kiếm theo khách hàng
        if ($request->filled('search')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // Lọc theo ngày
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Sắp xếp
        if ($request->filled('sort')) {
            if ($request->sort === 'user') {
                $query->join('users', 'orders.user_id', '=', 'users.id')
                      ->orderBy('users.name', 'asc');
            } else {
                $query->orderBy($request->sort);
            }
        }

        // Lấy tất cả các đơn hàng của người bán với phân trang
        $orders = $query->latest()->paginate(10);

        return view('seller.orders.index', compact('orders'));
    }

    public function show($id)
    {
        // Lấy đơn hàng cùng với các sản phẩm liên quan
        $order = Order::with('orderItems.product')->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    public function store(Request $request) {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'payment_method' => 'required|string',
            'total_amount' => 'required|numeric', // Thêm xác thực cho tổng số tiền
            'products' => 'required|array', // Xác thực rằng có sản phẩm
        ]);

        // Tạo đơn hàng mới
        $order = new Order();
        $order->user_id = auth()->id();
        $order->seller_id = "3";
        // $order->seller_id = $request->seller_id; // Thêm seller_id nếu cần
        $order->coupon_id = $request->coupon_id; // Thêm coupon_id nếu cần
        $order->total_amount = $request->total_amount; // Lưu tổng số tiền
        $order->status = 'pending'; // Trạng thái mặc định
        $order->shipping_name = $request->name;
        $order->shipping_address = $request->address;
        $order->shipping_phone = $request->phone;
        $order->save();

        // Lưu thông tin thanh toán vào bảng payments
        $payment = new Payment();
        $payment->order_id = $order->id;
        $payment->payment_method = $request->payment_method;
        $payment->amount = $request->total_amount;
        $payment->status = 'pending';
        $payment->save();

        // Lưu thông tin vào bảng order_item
        foreach ($request->products as $productData) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $productData['product_id']; // Lấy product_id từ mảng sản phẩm
            $orderItem->quantity = $productData['quantity']; // Lấy quantity từ mảng sản phẩm
            $orderItem->price = $productData['price']; // Lấy price từ mảng sản phẩm
            $orderItem->save();
        }


        // Xử lý các sản phẩm trong giỏ hàng
        

        // Xóa giỏ hàng sau khi đặt hàng
        Cart::destroy($order->user_id);
        if($request->payment_method == 'bank_transfer') {
            return redirect()->route('bank_transfer');
        }
        return redirect()->route('orders.index')->with('success', 'Đặt hàng thành công!');
    }

    private function calculateTotalAmount()
    {
        // Logic tính tổng giá trị đơn hàng
    }

    public function sellerShow($id)
    {
        // Tìm đơn hàng theo ID và load quan hệ với bảng 'user' và 'orderItems'
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);

        // Trả về view chi tiết đơn hàng, kèm dữ liệu đơn hàng
        return view('seller.orders.show', compact('order'));
    }
}
