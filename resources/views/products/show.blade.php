@extends('layouts.app')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="row">
    <div class="col-md-6">
        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="Sản phẩm">
    </div>
    <div class="col-md-6">
        <h1>{{ $product->name }}</h1>
        <p class="lead">{{ $product->price }} đ</p>
        <p>{{ $product->description }}</p>
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <label for="quantity" class="form-label">Số lượng</label>
                <input type="number" class="form-control" name="quantity" id="quantity" value="1" min="1">
            </div>
            <button type="submit" class="btn btn-primary btn-lg">Thêm vào giỏ hàng</button>
        </form>
        
    </div>
</div>

<div class="mt-5">
    <h2>Đánh giá sản phẩm</h2>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Người dùng 1</h5>
            <p class="card-text">Đánh giá của người dùng về sản phẩm...</p>
            <p class="card-text"><small class="text-muted">Đánh giá 2 ngày trước</small></p>
        </div>
    </div>
    <!-- Thêm các đánh giá khác -->
</div>
@endsection
