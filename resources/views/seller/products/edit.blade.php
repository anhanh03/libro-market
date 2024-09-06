@extends('layouts.app')

@section('title', 'Chỉnh sửa sản phẩm')

@section('content')
<h1 class="mb-4">Chỉnh sửa sản phẩm</h1>

<form action="{{ route('seller.products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Tên sản phẩm</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Mô tả</label>
        <textarea class="form-control" id="description" name="description" rows="3" required>{{ $product->description }}</textarea>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Giá</label>
        <input type="number" class="form-control" id="price" name="price" min="0" step="1000" value="{{ $product->price }}" required>
    </div>
    <div class="mb-3">
        <label for="stock" class="form-label">Số lượng trong kho</label>
        <input type="number" class="form-control" id="stock" name="stock" min="0" value="{{ $product->stock }}" required>
    </div>
    <div class="mb-3">
        <label for="category_id" class="form-label">Danh mục</label>
        <select class="form-select" id="category_id" name="category_id" required>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Hình ảnh sản phẩm</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        <small class="form-text text-muted">Để trống nếu không muốn thay đổi hình ảnh</small>
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
</form>
@endsection