<?php

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

Auth::routes();
Route::get('/', [App\Http\Controllers\FrontendController::class, 'beranda'])->name('/');
Route::get('/tentang-kami', [App\Http\Controllers\FrontendController::class, 'aboutUs'])->name('about-us');
Route::get('/blog', [App\Http\Controllers\FrontendController::class, 'news'])->name('news');
Route::get('/blog/{slug}', [App\Http\Controllers\FrontendController::class, 'newsDetail'])->name('news.detail');
Route::get('/registrasi-anggota', [App\Http\Controllers\FrontendController::class, 'registerMember'])->name('register.member');
Route::post('/registrasi-anggota', [App\Http\Controllers\FrontendController::class, 'submitRegisterMember'])->name('register.member.submit')->middleware('throttle:5,5');
Route::post('/list-region', [App\Http\Controllers\FrontendController::class, 'getWilayah'])->name('get-wilayah');
// Route::get('verifikasi-anggota/{id}/iwpi/by-qr', [App\Http\Controllers\FrontendController::class, 'anggotaProfile'])->name('anggota.profile');
Route::get('kartu-anggota/{id}/iwpi/by-qr', [App\Http\Controllers\FrontendController::class, 'kartuAnggota'])->name('anggota.kartu-anggota');
Route::post('kta/digital', [App\Http\Controllers\FrontendController::class, 'postKTA'])->name('form.kta-digital')->middleware('throttle:posts_routes');
Route::get('refresh_captcha', [App\Http\Controllers\FrontendController::class, 'refreshCaptcha'])->name('refresh_captcha');
Route::get('cara-pembayaran', [App\Http\Controllers\FrontendController::class, 'caraPembayaran'])->name('cara_pembayaran');
Route::get('konfirmasi-pembayaran', [App\Http\Controllers\FrontendController::class, 'konfirmasiPembayaran'])->name('konfirmasi-pembayaran');
Route::post('konfirmasi-pembayaran', [App\Http\Controllers\FrontendController::class, 'submitKonfirmasiPembayaran'])->name('konfirmasi-pembayaran.submit')->middleware('throttle:5,5');

// payment gateway midtrans system

Route::group(['prefix' => 'reg', 'name' => 'midtrans'], function () {
    Route::get('payment-waiting', [App\Http\Controllers\MidtransController::class, 'waitingPayment'])->name('waiting');
    Route::get('payment-success', [App\Http\Controllers\MidtransController::class, 'paymentSuccess'])->name('success');
    Route::get('payment-error', [App\Http\Controllers\MidtransController::class, 'paymentError'])->name('error');
});

Route::group(['middleware' => 'auth', 'prefix' => 'adm'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('blog', App\Http\Controllers\BlogController::class);
    Route::resource('categories', App\Http\Controllers\CategoriesController::class);
    Route::post('ckeditor/upload', [App\Http\Controllers\CkeditorController::class, 'upload'])->name('ckeditor.upload');

    // Route::get('register-anggota', [App\Http\Controllers\UserController::class, 'registerAnggota'])->name('register-anggota');
    Route::resource('register-anggota', App\Http\Controllers\PendaftaranAnggotaController::class);
    Route::post('register-anggota/update/{id}/status', [App\Http\Controllers\PendaftaranAnggotaController::class, 'updateStatusAggota'])->name('register-anggota.updatestatus');
    Route::get('register-anggota/kartu/{slug}/download', [App\Http\Controllers\PendaftaranAnggotaController::class, 'kartuAnggota'])->name('register-anggota.kartu-anggota');
    Route::resource('management-user', App\Http\Controllers\UserController::class);
    Route::get('profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::match(['put', 'patch'], 'myprofile', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('myprofile.update');

    Route::post('midtrans/request-new-payment-link', [App\Http\Controllers\PendaftaranAnggotaController::class, 'requestNewLinkPayment'])->name('midtrans.request-new-payment-link');
});
