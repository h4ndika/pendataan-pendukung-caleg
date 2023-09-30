<?php

use App\Http\Controllers\AdminWebController;
use App\Http\Controllers\AnggotaWebController;
use App\Http\Controllers\LoginWebController;
use App\Http\Controllers\KetuaWebController;
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
    return redirect('/login');
});
Route::get('/login', [LoginWebController::class, 'index']);
Route::get('/logout', [LoginWebController::class, 'logout']);

Route::group(['prefix'=>'admin'], function(){
    //Dashboard
    Route::get('/', [AdminWebController::class, 'index']);
    Route::get('/timses', [AdminWebController::class, 'timses']);
});

Route::group(['prefix'=>'ketua'], function(){
    //Dashboard
    Route::get('/', [KetuaWebController::class, 'index']);
    Route::get('/anggota', [KetuaWebController::class, 'anggota']);
});

Route::group(['prefix'=>'anggota'], function(){
    //Dashboard
    Route::get('/', [AnggotaWebController::class, 'index']);
    Route::get('/wilayah', [AnggotaWebController::class, 'wilayah']);
    Route::get('/pendukung', [AnggotaWebController::class, 'pendukung']);
});
