@extends('layouts.app')

@section('title', $category->name)

@section('content')
<h1 class="mb-4">{{ $category->name }}</h1>

<div class="row">
    @foreach($products as $product)
    <div class="col-md-3 mb-4">
        <div class="card">
            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top img-fit" alt="{{ $product->name }}">
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
@endsection
