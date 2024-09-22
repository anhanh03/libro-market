@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
<h1 class="mb-4">Giỏ hàng của bạn</h1>

@php
    $cartTotal = $cartItems->sum(function($item) {
        return $item->product->price * $item->quantity;
    });
@endphp

@if($cartItems->count() > 0)
<div class="row">
    <div class="col-md-8">
        @foreach($cartItems as $item)
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{ asset('storage/' . $item->product->image)}}" class="img-fluid" alt="{{ $item->product->name }}">
                    </div>
                    <div class="col-md-9">
                        <h5 class="card-title">{{ $item->product->name }}</h5>
                        <p class="card-text">Giá: {{ number_format($item->product->price) }} đ</p>
                        <form action="{{ route('cart.update', $item) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <div class="input-group mb-3" style="width: 150px;">
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input type="number" class="form-control" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}">
                                <button class="btn btn-outline-secondary" type="submit">Cập nhật</button>
                            </div>
                        </form>
                        <form action="{{ route('cart.remove', $item) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tổng cộng</h5>
                <p class="card-text">Tạm tính: {{ number_format($cartTotal) }} đ</p>
                @if(session('coupon'))
                <p class="card-text">Giảm giá: {{ number_format(session('coupon')->discount($cartTotal)) }} đ</p>
                @endif
                <h4>Tổng cộng: {{ number_format($cartTotal - (session('coupon') ? session('coupon')->discount($cartTotal) : 0)) }} đ</h4>
                <a href="{{ route('checkout') }}" class="btn btn-primary btn-block mt-3">Tiến hành thanh toán</a>
            </div>
        </div>
        @if(!session('coupon'))
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Mã giảm giá</h5>
                <form action="{{ route('coupon.apply') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="code" placeholder="Nhập mã giảm giá">
                        <button class="btn btn-outline-secondary" type="submit">Áp dụng</button>
                    </div>
                </form>
            </div>
        </div>
        @else
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Mã giảm giá đã áp dụng</h5>
                <p>{{ session('coupon')->code }}</p>
                <form action="{{ route('coupon.remove') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hủy mã giảm giá</button>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@else
<p>Giỏ hàng của bạn đang trống. <a href="{{ route('products.index') }}">Tiếp tục mua sắm</a></p>
@endif
@endsection
