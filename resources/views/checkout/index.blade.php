@extends('layouts.app')

@section('title', 'Thanh toán')

@section('content')
    <h1 class="mb-4">Thanh toán</h1>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Thông tin giao hàng</h5>
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ tên</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ auth()->user()->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                value="{{ auth()->user()->phone }}" required>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Phương thức thanh toán</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod"
                                value="cod" checked>
                            <label class="form-check-label" for="cod">
                                Thanh toán khi nhận hàng
                            </label>
                        </div>
                        
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer"
                                    value="bank_transfer">
                                <label class="form-check-label" for="bank_transfer">
                                    Chuyển khoản ngân hàng
                                </label>
                            </div>
                        
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Đơn hàng của bạn</h5>
                            <ul class="list-group list-group-flush">
                                @foreach ($cartItems as $item)
                                
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $item->product->name }} (x{{ $item->quantity }})
                                        <span>{{ number_format($item->product->price * $item->quantity) }} đ</span>
                                        <input type="hidden" name="products[{{ $item->product->id }}][seller_id]" value="{{ $item->product->seller_id }}">
                                        <input type="hidden" name="products[{{ $item->product->id }}][quantity]" value="{{ $item->quantity }}">
                                        <input type="hidden" name="products[{{ $item->product->id }}][price]" value="{{ $item->product->price * $item->quantity }}">
                                        <input type="hidden" name="products[{{ $item->product->id }}][product_id]" value="{{ $item->product_id }}">
                                    </li>
                                @endforeach
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Tổng cộng</strong>
                                    <strong>{{ number_format($cartTotal) }} đ</strong>
                                    <input type="hidden" name="total_amount" value="{{ $cartTotal }}">
                                </li>
                                @if (session('coupon'))
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center text-success">
                                        <span>Giảm giá ({{ session('coupon')->code }})</span>
                                        <span>-{{ number_format(session('coupon')->discount($cartTotal)) }} đ</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Thành tiền</strong>
                                        <strong>{{ number_format($cartTotal - session('coupon')->discount($cartTotal)) }}
                                            đ</strong>
                                        <input type="hidden" name="total_amount" value="{{ $cartTotal }}">
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-primary btn-lg mt-4" value="Đặt hàng">
    </form>
@endsection
