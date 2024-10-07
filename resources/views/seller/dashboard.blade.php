@extends('layouts.app')

@section('title', 'Trang quản lý người bán')

@section('content')
<h1 class="mb-4">Trang quản lý người bán</h1>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Tổng số sản phẩm</h5>
                <p class="card-text display-4 text-font-sz">{{ $totalProducts }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Tổng số đơn hàng</h5>
                <p class="card-text display-4 text-font-sz">{{ $totalOrders }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">Doanh thu tháng này</h5>
                <p class="card-text display-4 text-font-sz">{{ number_format($monthlyRevenue) }} đ</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h5 class="card-title">Đơn hàng chờ xử lý</h5>
                <p class="card-text display-4 text-font-sz">{{ $pendingOrders }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                Đơn hàng gần đây
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ number_format($order->total_amount) }} đ</td>
                            <td>{{ $order->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                Sản phẩm bán chạy
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng đã bán</th>
                            <th>Doanh thu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topSellingProducts as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->total_sold }}</td>
                            <td>{{ number_format($product->total_sold* $product->price) }} đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<a href="{{ route('seller.products') }}" class="btn btn-primary">Quản lý sản phẩm</a>
<a href="{{ route('seller.orders') }}" class="btn btn-primary">Quản lý đơn hàng</a>

@endsection
