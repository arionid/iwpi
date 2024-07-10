<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/list-region', [App\Http\Controllers\FrontendController::class, 'getWilayah']);
Route::post('/pembayaran/npwp', [App\Http\Controllers\FrontendController::class, 'cekTagihan'])->middleware('throttle:5,5');


Route::prefix('/v1/midtrans')->group(function () {
    Route::post('notification-handler', [App\Http\Controllers\MidtransController::class, 'notificationHandler']);
});
