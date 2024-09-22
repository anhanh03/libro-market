@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng #' . $order->id)

@section('content')
<h1 class="mb-4">Chi tiết đơn hàng #{{ $order->id }}</h1>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Thông tin đơn hàng</h5>
                <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Trạng thái:</strong> 
                    @switch($order->status)
                        @case('pending')
                            <span class="badge bg-warning">Chờ xử lý</span>
                            @break
                        @case('processing')
                            <span class="badge bg-info">Đang xử lý</span>
                            @break
                        @case('shipped')
                            <span class="badge bg-primary">Đã giao hàng</span>
                            @break
                        @case('completed')
                            <span class="badge bg-success">Hoàn thành</span>
                            @break
                        @case('cancelled')
                            <span class="badge bg-danger">Đã hủy</span>
                            @break
                        @default
                            <span class="badge bg-secondary">Không xác định</span>
                    @endswitch
                </p>
                <p><strong>Phương thức thanh toán:</strong> {{ $order->payment->payment_method }}</p>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Sản phẩm</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($order->orderItems->isNotEmpty())
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price) }} đ</td>
                                <td>{{ number_format($item->price * $item->quantity) }} đ</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">Không có sản phẩm nào.</td>
                            </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                            <td><strong>{{ number_format($order->total_amount) }} đ</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Thông tin giao hàng</h5>
                <p><strong>Họ tên:</strong> {{ $order->shipping_name }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
                <p><strong>Số điện thoại:</strong> {{ $order->shipping_phone }}</p>
            </div>
        </div>
        @if($order->shipping)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Thông tin vận chuyển</h5>
                <p><strong>Phương thức:</strong> {{ $order->shipping->method }}</p>
                <p><strong>Mã vận đơn:</strong> {{ $order->shipping->tracking_number }}</p>
                <p><strong>Trạng thái:</strong> {{ $order->shipping->status }}</p>
                <p><strong>Ngày giao hàng dự kiến:</strong> {{ $order->shipping->estimated_delivery_date->format('d/m/Y') }}</p>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection