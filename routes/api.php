<?php

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

Route::prefix('v1')->group(function () {
    Route::post('auth/login', [App\Http\Controllers\Api\AuthController::class, 'login'])->middleware('throttle:10,1');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('auth/me', [App\Http\Controllers\Api\AuthController::class, 'me']);
        Route::post('auth/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);

        Route::get('members', [App\Http\Controllers\Api\MemberController::class, 'index']);
        Route::get('members/search', [App\Http\Controllers\Api\MemberController::class, 'index']);
        Route::post('members', [App\Http\Controllers\Api\MemberController::class, 'store']);
        Route::get('members/{id}', [App\Http\Controllers\Api\MemberController::class, 'show'])->whereNumber('id');
        Route::match(['put', 'patch', 'post'], 'members/{id}', [App\Http\Controllers\Api\MemberController::class, 'update'])->whereNumber('id');
    });
});

Route::post('/list-region', [App\Http\Controllers\FrontendController::class, 'getWilayah']);
Route::post('/pembayaran/npwp', [App\Http\Controllers\FrontendController::class, 'cekTagihan'])->middleware('throttle:5,5');


Route::prefix('/v1/midtrans')->group(function () {
    Route::post('notification-handler', [App\Http\Controllers\MidtransController::class, 'notificationHandler']);
});
