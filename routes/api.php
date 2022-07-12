<?php

use App\Http\Controllers\Auth\CheckAuth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\Service\ServiceController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', RegisterController::class);
Route::post('/login', LoginController::class);
Route::post('/logout', LogoutController::class);
Route::get('/user', [UserController::class, 'index'])->middleware('auth:api');
Route::post('/check-auth', CheckAuth::class)->middleware('auth:api');

Route::post('create-service', [ServiceController::class, 'store'])->middleware('auth:api');
Route::get('/check-service', [ServiceController::class, 'checkService'])->middleware('auth:api');
Route::get('/services', [ServiceController::class, 'getAllServices'])->middleware('auth:api');
Route::get('/service/{service:slug}', [ServiceController::class, 'getService'])->middleware('auth:api');
Route::get('/service-bypenjual', [ServiceController::class, 'getServiceByPenjual'])->middleware('auth:api');
Route::get('/search/{keyword}', [ServiceController::class, 'getServicesByKeyword'])->middleware('auth:api');

Route::post('/create-order', [OrderController::class, 'store'])->middleware('auth:api');
Route::get('/orders', [OrderController::class, 'getOrders'])->middleware('auth:api');
Route::get('/order/{id}', [OrderController::class, 'getOrder'])->middleware('auth:api');
Route::post('/order/change-status', [OrderController::class, 'changeStatus'])->middleware('auth:api');
Route::post('/order/confirm', [OrderController::class, 'confirmOrder'])->middleware('auth:api');
Route::get('/orderscount', [OrderController::class, 'getOrdersCount'])->middleware('auth:api');

Route::post('/create-comment', [RatingController::class, 'store'])->middleware('auth:api');
Route::get('/comment/{service_id}', [RatingController::class, 'getCommentByService'])->middleware('auth:api');

Route::post('/transaksi', [TransaksiController::class, 'store'])->middleware('auth:api');