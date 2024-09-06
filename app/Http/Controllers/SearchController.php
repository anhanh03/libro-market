<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        // Hiển thị trang tìm kiếm
        return view('search.index');
    }

    public function search(Request $request)
    {
        // Xử lý tìm kiếm
        $query = $request->input('query');
        // Thực hiện tìm kiếm và lấy kết quả
        $results = $this->performSearch($query);
        
        return view('search.results', ['results' => $results]);
    }

    private function performSearch($query)
    {
        // Sử dụng Eloquent để tìm kiếm trong bảng 'products'
        $results = \App\Models\Product::where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->orWhereHas('category', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->with('category') // Eager load category để tránh N+1 query problem
            ->paginate(10); // Phân trang kết quả, 10 sản phẩm mỗi trang

        return $results;
    }

    public function advancedSearch(Request $request)
    {
        // Xử lý tìm kiếm nâng cao
        // ...
    }
}
