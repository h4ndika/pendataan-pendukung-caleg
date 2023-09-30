<?php

use App\Http\Controllers\AdminWebController;
use App\Http\Controllers\LoginWebController;
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
