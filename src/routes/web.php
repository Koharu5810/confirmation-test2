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
    // 商品一覧
    Route::get('', [ProductController::class, 'index'])->name('products.index');
    // 検索
    Route::get('/search', [ProductController::class, 'search'])->name('products.search');
    // 商品登録
    Route::get('/register', [ProductController::class, 'create'])->name('products.register');
    Route::post('/register', [ProductController::class, 'store']);
    // 商品詳細
    Route::get('/{productId}', [ProductController::class, 'show'])->name('products.show');
    // 商品更新
    Route::patch('/{productId}/update', [ProductController::class, 'update'])->name('products.update');
    // 削除
    Route::delete('/{productId}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
});
