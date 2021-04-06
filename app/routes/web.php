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

// トップページ
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

// 管理画面
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
  Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);
});
