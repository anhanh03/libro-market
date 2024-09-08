@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Đăng ký người bán</h2>
    <form action="{{ route('seller.register.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Thêm các trường thông tin cần thiết cho người bán -->
        <div class="mb-3">
            <label for="shop_name" class="form-label">Tên shop</label>
            <input type="text" class="form-control" id="shop_name" name="shop_name" required>
        </div>
        <div class="mb-3">
            <label for="business_name" class="form-label">Tên doanh nghiệp</label>
            <input type="text" class="form-control" id="business_name" name="business_name" required>
        </div>
        <div class="mb-3">
            <label for="business_address" class="form-label">Địa chỉ doanh nghiệp</label>
            <input type="text" class="form-control" id="business_address" name="business_address" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>
            <input type="file" class="form-control" id="logo" name="logo" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <button type="submit" class="btn btn-primary">Đăng ký</button>
    </form>
</div>
@endsection
