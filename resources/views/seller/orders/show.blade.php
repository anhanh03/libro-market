@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<h1 class="mb-4">Chi tiết đơn hàng #{{ $order->id }}</h1>

<div class="card">
    <div class="card-body">
        <h4>Thông tin khách hàng</h4>
        <ul class="list-group mb-4">
            <li class="list-group-item"><strong>Họ tên: </strong>{{ $order->user->name }}</li>
            <li class="list-group-item"><strong>Email: </strong>{{ $order->user->email }}</li>
            <li class="list-group-item"><strong>Số điện thoại: </strong>{{ $order->shipping_phone }}</li>
            <li class="list-group-item"><strong>Địa chỉ giao hàng: </strong>{{ $order->shipping_address }}</li>
        </ul>

        <h4>Trạng thái đơn hàng</h4>
        <ul class="list-group mb-4">
            <li class="list-group-item">
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
            </li>
            <li class="list-group-item"><strong>Ngày đặt hàng: </strong>{{ $order->created_at->format('d/m/Y H:i') }}</li>
            <li class="list-group-item"><strong>Ngày cập nhật: </strong>{{ $order->updated_at->format('d/m/Y H:i') }}</li>
        </ul>

        <h4>Thông tin thanh toán</h4>
        <ul class="list-group mb-4">
            <li class="list-group-item"><strong>Phương thức thanh toán: </strong>{{ ucfirst($order->payment_method) }}</li>
            <li class="list-group-item"><strong>Trạng thái thanh toán: </strong>
                @if($order->payment_status == 'paid')
                    <span class="badge bg-success">Đã thanh toán</span>
                @else
                    <span class="badge bg-danger">Chưa thanh toán</span>
                @endif
            </li>
            <li class="list-group-item"><strong>Tổng số tiền: </strong>{{ number_format($order->total_amount) }} đ</li>
        </ul>

        <h4>Sản phẩm trong đơn hàng</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price) }} đ</td>
                    <td>{{ number_format($item->price * $item->quantity) }} đ</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('seller.orders.index') }}" class="btn btn-secondary mt-4">Quay lại quản lý đơn hàng</a>
    </div>
</div>
@endsection
