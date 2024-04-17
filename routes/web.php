<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
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
    return view('index');
});

Route::get('login',[AuthController::class, 'index'])->name('login');
Route::post('login',[AuthController::class, 'login']);

Route::middleware('auth')->group(function(){
    Route::middleware('onlyadmin')->group(function(){
        Route::get('/dashboard',[AdminController::class, 'getDashboard']);
    });
});
