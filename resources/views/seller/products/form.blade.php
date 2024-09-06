@extends('layouts.app')

@section('title', 'Thêm/Sửa sản phẩm')

@section('content')
<h1 class="mb-4">{{ isset($product) ? 'Sửa sản phẩm' : 'Thêm sản phẩm mới' }}</h1>

<div class="card">
    <div class="card-body">
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Số lượng</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Danh mục</label>
                <select class="form-select" id="category" name="category_id">
                    <option selected>Chọn danh mục</option>
                    <option value="1">Danh mục 1</option>
                    <option value="2">Danh mục 2</option>
                    <option value="3">Danh mục 3</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh sản phẩm</label>
                <input class="form-control" type="file" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Cập nhật' : 'Thêm sản phẩm' }}</button>
        </form>
    </div>
</div>
@endsection
