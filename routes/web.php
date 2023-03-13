<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
   
Route::get('/services', [PagesController::class, 'services'])->name('services');
Route::get('/walkin', [PagesController::class, 'walkin'])->name('walkin');
Route::post('/services/edit', [ServicesController::class, 'edit'])->name('services.edit');
Route::post('/services/add', [ServicesController::class, 'add'])->name('services.add');

Route::get('/staff', [PagesController::class, 'staff'])->name('staff');
Route::get('/sales', [PagesController::class, 'sales'])->name('sales');
Route::get('/bookings', [PagesController::class, 'bookings'])->name('bookings');

Route::post('/customer/verify', [UserController::class, 'verify'])->name('customer.verify');
Route::post('/customer/unverify', [UserController::class, 'unverify'])->name('customer.unverify');
Route::post('/customer/book', [BookController::class, 'book'])->name('customer.book');
Route::post('/staff/add', [UserController::class, 'add'])->name('staff.add');
Route::post('/book', [BookController::class, 'book'])->name('book');
Route::post('/book/checkin', [BookController::class, 'checkin'])->name('book.checkin');
Route::post('/book/cancel', [BookController::class, 'cancel'])->name('book.cancel');
Route::get('/book/check/{id}', [BookController::class, 'check'])->name('book.check');
Route::post('/book/pay', [BookController::class, 'pay'])->name('book.pay');
Route::post('/book/pay/confirm', [BookController::class, 'confirm'])->name('book.pay.confirm');
Route::post('/book/pay/decline', [BookController::class, 'decline'])->name('book.pay.decline');
Route::post('/book/checkout', [BookController::class, 'checkout'])->name('book.checkout');
Route::post('/book/remove', [BookController::class, 'remove'])->name('book.remove');
Route::get('/profile/{id}/{check}', [PagesController::class, 'profile'])->name('profile.show');
Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');
Route::post('/profile/changepass', [UserController::class, 'changepass'])->name('profile.changepass');

Route::get('/chart', [BookController::class, 'chart'])->name('chart');
});
Route::get('/', function () { return view('pages.home');})->name('home');

Route::get('/home', [PagesController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/reg', [AuthController::class, 'reg'])->name('reg');
Route::post('/log', [AuthController::class, 'log'])->name('log');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/reload-captcha', [AuthController::class, 'reloadCaptcha']);