<?php

use App\Http\Controllers\APIv1\AnggotaController;
use App\Http\Controllers\APIv1\Auth\AuthController;
use App\Http\Controllers\APIv1\KetuaController;
use App\Http\Controllers\APIv1\PendukungController;
use App\Http\Controllers\APIv1\WilayahController;
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

Route::prefix('auth')->namespace('Auth')->group(function () {
    Route::prefix('/{guard}')->group(function () {
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::post('/change-password', [AuthController::class, 'changePassword'])->name('auth.change-password');
    });
    Route::get('/me', [AuthController::class, 'me']);
});

Route::apiResource('anggotas', AnggotaController::class);
Route::apiResource('ketuas', KetuaController::class);
Route::apiResource('wilayahs', WilayahController::class);
Route::apiResource('pendukungs', PendukungController::class);
