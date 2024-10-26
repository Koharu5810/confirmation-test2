<?php

use App\Http\Controllers\ProductController;
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

Route::get('/index', function () {
    return view('index');
});
Route::get('/admin', function () {
    return view('admin');
});
Route::get('/register', function () {
    return view('register');
});

Route::prefix('/products')->group(function (){
    // 商品一覧
    Route::get('', [ProductController::class, 'index']);
    // 商品詳細
    Route::get('/{productId}', [ProductController::class, 'show']);
    // 商品更新
    Route::post('/{productId}/update', [ProductController::class, 'update']);
    // 商品登録
    Route::get('/register', [ProductController::class, 'create']);
    Route::post('/register', [ProductController::class, 'store']);
    // 検索
    Route::get('/search', [ProductController::class, 'search']);
    // 削除
    Route::post('/{productId}/delete', [ProductController::class, 'destroy']);
});
