@extends('layouts.app')

@section('title', 'Danh mục sản phẩm')

@section('content')
<h1 class="mb-4">Danh mục sản phẩm</h1>

<div class="row">
    @foreach($categories as $category)
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $category->name }}</h5>
                <p class="card-text">{{ $category->products_count }} sản phẩm</p>
                <a href="{{ route('categories.show', $category) }}" class="btn btn-primary">Xem danh mục</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{ $categories->links() }}
@endsection
