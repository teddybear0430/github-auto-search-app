<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SearchResultController;

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
  Route::get('/', [
    App\Http\Controllers\Admin\DashboardController::class,
    'index'
  ])->name('admin');

  // 検索キーワードの編集関連
  Route::resource('/keyword', App\Http\Controllers\Admin\KeywordGroupController::class)
    ->except(['index', 'show']);

  // クローリング処理
  Route::post('/github-crawling/{keyword_group_id}', [
    App\Http\Controllers\Admin\ManualCheckController::class,
    'manual_check'
  ])->name('manual_check');

  // 検索結果の表示
  Route::get('/search-result/{id}', [SearchResultController::class, 'show'])
    ->name('search_result');

  // 検索結果のCSVダウンロード
  Route::get('/search-result/csv-download/{id}', [SearchResultController::class, 'csv_download'])
    ->name('search_result_csv_download');
});
