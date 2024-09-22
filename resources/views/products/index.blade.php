@extends('layouts.app')

@section('title', 'Danh sách sản phẩm')

@section('content')
<h1 class="mb-4">Danh sách sản phẩm</h1>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Bộ lọc
            </div>
            <div class="card-body">
                <form action="{{ route('products.index') }}" method="GET">
                    <div class="mb-3">
                        <label for="category" class="form-label">Danh mục</label>
                        <select class="form-select" id="category" name="category">
                            <option value="">Tất cả</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price_range" class="form-label">Khoảng giá</label>
                        <input type="range" class="form-range" id="price_range" name="price_range" min="0" max="1000000" step="100000" value="{{ request('price_range', 1000000) }}">
                        <div class="d-flex justify-content-between">
                            <span>0đ</span>
                            <span>1.000.000đ</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Lọc</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ number_format($product->price) }} đ</p>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{ $products->links() }}
    </div>
</div>
@endsection
