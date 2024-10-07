@extends('layouts.app')

@section('title', 'Trang chủ - Chợ Điện Tử')

@section('content')
<div class="jumbotron bg-primary text-white text-center py-5 mb-4">
    <h1 class="display-4">Chào mừng đến với Chợ Điện Tử</h1>
    <p class="lead">Khám phá hàng ngàn sản phẩm chất lượng với giá cả hợp lý</p>
    <a href="{{ route('products.index') }}" class="btn btn-light btn-lg">Mua sắm ngay</a>
</div>

<h2 class="mb-4">Sản phẩm nổi bật</h2>
<div class="row">
    @foreach($featuredProducts as $product)
    <div class="col-md-3 mb-4">
        <div class="card">
            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top img-fit " alt="{{ $product->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ number_format($product->price) }} đ</p>
                <a href="{{ route('products.show', $product) }}" class="btn btn-primary">Xem chi tiết</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<h2 class="mb-4 mt-5">Danh mục sản phẩm</h2>
<div class="row">
    @foreach($categories as $category)
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $category->name }}</h5>
                <p class="card-text">{{ $category->products_count }} sản phẩm</p>
                <a href="{{ route('categories.show', $category) }}" class="btn btn-outline-primary">Xem danh mục</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
