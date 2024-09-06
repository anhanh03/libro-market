@extends('layouts.app')

@section('title', 'Thống kê doanh thu')

@section('content')
<h1 class="mb-4">Thống kê doanh thu</h1>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Doanh thu tháng này</h5>
                <p class="display-4">15.000.000 đ</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">So với tháng trước</h5>
                <p class="display-4 text-success">+15%</p>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        Biểu đồ doanh thu
    </div>
    <div class="card-body">
        <canvas id="revenueChart" width="400" height="200"></canvas>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Doanh thu theo sản phẩm
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng bán</th>
                    <th>Doanh thu</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 5; $i++)
                <tr>
                    <td>Sản phẩm {{ $i }}</td>
                    <td>{{ rand(10, 100) }}</td>
                    <td>{{ number_format(rand(1000000, 5000000)) }} đ</td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('revenueChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
            datasets: [{
                label: 'Doanh thu (triệu đồng)',
                data: [12, 19, 3, 5, 2, 3, 10, 15, 8, 12, 17, 15],
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection