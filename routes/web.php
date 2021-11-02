<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\backend\social\FacebookController;
use App\Http\Controllers\backend\dashboard\DashboardController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/', [FrontendController::class, 'index'])->name('index');

Route::get('auth/facebook', [FacebookController::class, 'facebookRedirect'])->name('login.fb');

Route::get('auth/facebook/callback', [FacebookController::class, 'loginWithFacebook'])->name('callback.facebook');