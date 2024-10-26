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

Route::prefix('/products')->group(function (){
    // 商品登録
    Route::get('/register', [ProductController::class, 'create']);
    Route::post('/register', [ProductController::class, 'store']);
    // 商品一覧
    Route::get('', [ProductController::class, 'index'])->name('products.index');
    // 商品詳細
    Route::get('/{productId}', [ProductController::class, 'show']);
    // 商品変更
    Route::post('/{productId}/update', [ProductController::class, 'update']);
    // 検索
    Route::get('/search', [ProductController::class, 'search']);
    // 削除
    Route::post('/{productId}/delete', [ProductController::class, 'destroy']);
});
