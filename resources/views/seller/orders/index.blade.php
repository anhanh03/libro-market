@extends('layouts.app')

@section('title', 'Quản lý đơn hàng')

@section('content')
<h1 class="mb-4">Quản lý đơn hàng</h1>

<!-- Thêm form tìm kiếm -->
<form method="GET" action="{{ route('seller.orders.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo khách hàng" value="{{ request('search') }}">
        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
        <button class="btn btn-primary" type="submit">Tìm kiếm</button>
    </div>
</form>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th><a href="{{ route('seller.orders.index', ['sort' => 'id']) }}">ID</a></th>
                    <th><a href="{{ route('seller.orders.index', ['sort' => 'user']) }}">Khách hàng</a></th>
                    <th><a href="{{ route('seller.orders.index', ['sort' => 'total_amount']) }}">Tổng tiền</a></th>
                    <th><a href="{{ route('seller.orders.index', ['sort' => 'status']) }}">Trạng thái</a></th>
                    <th><a href="{{ route('seller.orders.index', ['sort' => 'created_at']) }}">Ngày đặt hàng</a></th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
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
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('seller.orders.show', $order) }}" class="btn btn-sm btn-primary">Chi tiết</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $orders->onEachSide(1)->links('pagination::bootstrap-4', ['class' => 'pagination-sm']) }}
</div>

@endsection