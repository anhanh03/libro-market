@extends('layouts.app')

@section('title', 'Hồ sơ người dùng')

@section('content')
<h1 class="mb-4">Hồ sơ của tôi</h1>

<div class="row">
    <div class="col-md-3">
        <div class="card mb-4">
            <div class="card-body text-center">
                <img src="https://via.placeholder.com/150" class="rounded-circle mb-3" alt="Avatar">
                <h5 class="card-title">{{ $user->name }}</h5>
                <p class="card-text">Thành viên từ: {{ $user->created_at->format('d/m/Y') }}</p>
            </div>
        </div>
        <div class="list-group">
            <a href="#profile" class="list-group-item list-group-item-action active" data-bs-toggle="list">Thông tin cá nhân</a>
            <a href="#password" class="list-group-item list-group-item-action" data-bs-toggle="list">Đổi mật khẩu</a>
            <a href="{{ route('orders.index') }}" class="list-group-item list-group-item-action">Đơn hàng của tôi</a>
        </div>
    </div>
    <div class="col-md-9">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="profile">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Thông tin cá nhân</h5>
                        <form action="{{ route('user.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Họ tên</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="password">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Đổi mật khẩu</h5>
                        <form action="{{ route('user.password.change') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Mật khẩu mới</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
