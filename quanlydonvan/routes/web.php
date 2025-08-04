<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layout.dashboard');
});

Route::get('/create_package', function () {
    return view('layout.create_package');
})->middleware('auth')->name('create_package');
Route::get('/create_package_step2', function () {
    return view('layout.create_package_step2');
})->middleware('auth')->name('create_package_step2');
Route::get('/order_detail', function () {
    return view('layout.order_detail');
})->middleware('auth')->name('order_detail');
Route::get('/package_manager', function () {
    return view('layout.package_manager');
})->middleware('auth')->name('package_manager');
Route::get('/landing_status', function () {
    return view('layout.landing_status');
})->middleware('auth')->name('landing_status');
Route::get('/pickup_package', function () {
    return view('layout.pickup_package');
})->middleware('auth')->name('pickup_package');
Route::get('/payment_management', function () {
    return view('layout.payment_management');
})->middleware('auth')->name('payment_management');
Route::get('/statistics_management', function () {
    return view('layout.statistics_management');
})->middleware('auth')->name('statistics_management');
Route::get('/service_management', function () {
    return view('layout.service_management');
})->middleware('auth')->name('service_management');
Route::get('/customer_list', function () {
    return view('layout.customer_list');
})->middleware('auth')->name('customer_list');
Route::get('/employee_list', function () {
    return view('layout.employee_list');
})->middleware('auth')->name('employee_list');
Route::get('/order_tracking', function () {
    return view('layout.order_tracking');
})->middleware('auth')->name('order_tracking');
// Route::get('/login', function () {
//     return view('login');
// });

// Hiển thị form đăng nhập

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Xử lý đăng nhập
Route::post('/login', [LoginController::class, 'login']);
// Đăng xuất
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Dashboard
Route::get('/dashboard', function () {
    return view('/layout.dashboard');
})->middleware('auth')->name('dashboard');
// Trang chủ (index)
Route::get('/', function () {
    return view('index');
})->name('home');