<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Middleware\SellerMiddleware; // Import middleware

// Trang chủ và các trang tĩnh
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Danh mục
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Hồ sơ người dùng
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::put('/profile/password', [UserController::class, 'changePassword'])->name('user.password.change');
});

// Mã giảm giá
Route::post('/coupon/apply', [CouponController::class, 'apply'])->name('coupon.apply');
Route::delete('/coupon/remove', [CouponController::class, 'remove'])->name('coupon.remove');

// Thanh toán
Route::post('/orders/{order}/pay', [PaymentController::class, 'process'])->name('payment.process');

// Vận chuyển (chỉ cho người bán)
Route::middleware(['auth', SellerMiddleware::class])->group(function () {
    Route::put('/orders/{order}/shipping', [ShippingController::class, 'update'])->name('shipping.update');
});

// Sản phẩm
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Giỏ hàng
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{item}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');

// Đơn hàng
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

// Tìm kiếm
Route::get('/search', [SearchController::class, 'index'])->name('search.index');

// Người bán
Route::middleware(['auth', SellerMiddleware::class])->group(function () {
    Route::get('/seller/dashboard', [SellerController::class, 'dashboard'])->name('seller.dashboard');
    Route::get('/seller/products', [ProductController::class, 'sellerIndex'])->name('seller.products');
    Route::get('/seller/products/create', [ProductController::class, 'create'])->name('seller.products.create');
    Route::post('/seller/products', [ProductController::class, 'store'])->name('seller.products.store');
    Route::get('/seller/products/{product}/edit', [ProductController::class, 'edit'])->name('seller.products.edit');
    Route::put('/seller/products/{product}', [ProductController::class, 'update'])->name('seller.products.update');
    Route::delete('/seller/products/{product}', [ProductController::class, 'destroy'])->name('seller.products.destroy');
    Route::get('/seller/orders', [OrderController::class, 'sellerIndex'])->name('seller.orders');
    Route::get('/seller/orders/{order}', [OrderController::class, 'sellerShow'])->name('seller.orders.show');
});

// Xác thực
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/seller/register', [SellerController::class, 'showRegisterForm'])->name('seller.register');
Route::post('/seller/register', [SellerController::class, 'register'])->name('seller.register.post');
