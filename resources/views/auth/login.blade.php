@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')
<div class="form-bg">
    <div class="container mx-auto">
        <div class="row">
            <div class="mt-5">
                <div class="form-container">
                    <div class="left-content bg-white">
                        <img class="img-fit" src="img/libro.png" alt="pageLetf" srcset="">
                    </div>
                    <div class="right-content">
                        <h3 class="form-title">Đăng nhập</h3>
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label>Username / Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button class="btn signin " type="submit">Đăng nhập</button>
                            <div class="remember-me">
                                <input type="checkbox" class="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="check-label">Ghi nhớ đăng nhập</span>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot">Quên mật khẩu?</a>
                            @endif
                        </form>
                        <span class="separator">HOẶC</span>
                        <ul class="social-links">
                            <li><a href="#"><i class="fab fa-google"></i> Đăng nhập với Google</a></li>
                            <li><a href="#"><i class="fab fa-facebook-f"></i> Đăng nhập với Facebook</a></li>
                        </ul>
                        <span class="signup-link">Chưa có tài khoản? Đăng ký <a href="{{ route('register') }}">tại đây</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
