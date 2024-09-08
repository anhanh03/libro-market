@extends('layouts.app')

@section('title', 'Thêm sản phẩm mới')

@section('content')
<h1 class="mb-4">Thêm sản phẩm mới</h1>

<form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Tên sản phẩm</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Mô tả</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Giá</label>
        <input type="number" class="form-control" id="price" name="price" min="0" step="1000" required>
    </div>
    <div class="mb-3">
        <label for="stock" class="form-label">Số lượng trong kho</label>
        <input type="number" class="form-control" id="stock" name="stock" min="0" required>
    </div>
    <div class="mb-3">
        <label for="category_id" class="form-label">Danh mục</label>
        <select class="form-select" id="category_id" name="category_id" required>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Hình ảnh sản phẩm</label>
        <input type="file" class="form-control" id="image" name="image" required>
    </div>
    <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
</form>
@endsection