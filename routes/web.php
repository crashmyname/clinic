<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('users/index');
});

    Route::post('/login', [UserController::class, 'onLogin'])->name('login');
    Route::post('/regist', [UserController::class, 'regist'])->name('regist');
    Route::get('/register', [UserController::class, 'register'])->name('form_tambah');
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::post('/logout', [UserController::class, 'LogOut'])->name('logout');

Route::post('/email', [EmailController::class, 'email']);
