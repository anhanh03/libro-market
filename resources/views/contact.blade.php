@extends('layouts.app')

@section('title', 'Liên hệ')

@section('content')
<h1 class="mb-4">Liên hệ với chúng tôi</h1>

<div class="row">
    <div class="col-md-6">
        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Họ tên</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Chủ đề</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Nội dung</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gửi tin nhắn</button>
        </form>
    </div>
    <div class="col-md-6">
        <h4>Thông tin liên hệ</h4>
        <p><strong>Địa chỉ:</strong> 123 Đường ABC, Quận XYZ, Thành phố HCM</p>
        <p><strong>Điện thoại:</strong> (028) 1234 5678</p>
        <p><strong>Email:</strong> info@chodientu.com</p>
        <div class="mt-4">
            <h4>Giờ làm việc</h4>
            <p>Thứ Hai - Thứ Sáu: 8:00 - 17:00</p>
            <p>Thứ Bảy: 8:00 - 12:00</p>
            <p>Chủ Nhật: Nghỉ</p>
        </div>
    </div>
</div>
@endsection
