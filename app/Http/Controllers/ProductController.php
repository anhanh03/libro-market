<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests; // Thêm dòng này

    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('price_range')) {
            $query->where('price', '<=', $request->price_range);
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function sellerIndex()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem sản phẩm.');
        }

        // Lấy người dùng hiện tại
        $user = Auth::user();
        $seller = Seller::where('user_id', $user->id)->first();
        // Lấy sản phẩm của người dùng bằng Eloquent Query Builder
        $products = Product::where('seller_id', $seller->id)->paginate(10);

        // Kiểm tra xem có sản phẩm nào không
        if ($products->isEmpty()) {
            return view('seller.products.index', ['products' => $products])->with('error', 'Không có sản phẩm nào.');
        }

        return view('seller.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('seller.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $seller = Auth::user()->seller;

        if (!$seller) {
            return redirect()->route('seller.products.create')->with('error', 'Người bán không tồn tại.');
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            
        } else {
            
            $imagePath = '/';
           
        }

        
        $product = $seller->products()->create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'image' => $imagePath,
            'stock' => $validatedData['stock'],
            'category_id' => $validatedData['category_id'],
            'seller_id' => $seller->id,
        ]);
        

        return redirect()->route('seller.products')->with('success', 'Sản phẩm đã được tạo thành công.');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $categories = Category::all();
        return view('seller.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image_url = $imagePath;
        }

        $product->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'category_id' => $validatedData['category_id'],
        ]);

        return redirect()->route('seller.products')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();
        return redirect()->route('seller.products')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}
