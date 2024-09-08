@extends('layouts.app')

@section('title', 'Đăng ký')

@section('content')
<div class="form-bg">
    <div class="container mx-auto">
        <div class="row">
            <div class="mt-5">
                <div class="form-container">
                    <div class="left-content bg-white">
                        <img class="img-fit" src="img/libro.png" alt="pageLeft" srcset="">
                    </div>
                    <div class="right-content">
                        <h3 class="form-title">Đăng ký</h3>
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label>Tên</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Xác nhận mật khẩu</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <button class="btn signin" type="submit">Đăng ký</button>
                        </form>
                        <span class="separator">HOẶC</span>
                        <ul class="social-links">
                            <li><a href="#"><i class="fab fa-google"></i> Đăng ký với Google</a></li>
                            <li><a href="#"><i class="fab fa-facebook-f"></i> Đăng ký với Facebook</a></li>
                        </ul>
                        <span class="signup-link">Đã có tài khoản? Đăng nhập <a href="{{ route('login') }}">tại đây</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
