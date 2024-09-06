@extends('layouts.app')

@section('title', 'Tìm kiếm sản phẩm')

@section('content')
<h1 class="mb-4">Kết quả tìm kiếm cho "{{ $searchTerm }}"</h1>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Bộ lọc tìm kiếm
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="category" class="form-label">Danh mục</label>
                        <select class="form-select" id="category">
                            <option selected>Tất cả</option>
                            <option>Điện tử</option>
                            <option>Thời trang</option>
                            <option>Gia dụng</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price-range" class="form-label">Khoảng giá</label>
                        <input type="range" class="form-range" id="price-range">
                    </div>
                    <div class="mb-3">
                        <label for="sort" class="form-label">Sắp xếp theo</label>
                        <select class="form-select" id="sort">
                            <option>Liên quan nhất</option>
                            <option>Giá: Thấp đến cao</option>
                            <option>Giá: Cao đến thấp</option>
                            <option>Mới nhất</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Áp dụng</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="row">
            @for ($i = 1; $i <= 6; $i++)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Sản phẩm {{ $i }}">
                    <div class="card-body">
                        <h5 class="card-title">Sản phẩm {{ $i }}</h5>
                        <p class="card-text">Giá: {{ number_format(rand(100000, 1000000)) }} đ</p>
                        <a href="#" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            @endfor
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="#">Trước</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Sau</a></li>
            </ul>
        </nav>
    </div>
</div>
@endsection
