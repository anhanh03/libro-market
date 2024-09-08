@extends('layouts.app')

@section('title', 'Quản lý sản phẩm')

@section('content')
<h1 class="mb-4">Quản lý sản phẩm</h1>

<a href="{{ route('seller.products.create') }}" class="btn btn-primary mb-3">Thêm sản phẩm mới</a>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Danh mục</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price) }} đ</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->category_id }}</td>
                    <td>
                        <a href="{{ route('seller.products.edit', $product) }}" class="btn btn-sm btn-primary">Sửa</a>
                        <form action="{{ route('seller.products.destroy', $product) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{ $products->links() }}
@endsection
