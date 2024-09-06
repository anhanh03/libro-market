@extends('layouts.app')

@section('title', 'Đơn hàng của tôi')

@section('content')
<h1 class="mb-4">Đơn hàng của tôi</h1>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ number_format($order->total_amount) }} đ</td>
                    <td>
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
                    </td>
                    <td>
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-primary">Chi tiết</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{ $orders->links() }}
@endsection