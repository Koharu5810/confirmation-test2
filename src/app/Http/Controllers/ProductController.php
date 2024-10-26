<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;
use Psy\CodeCleaner\ReturnTypePass;

class ProductController extends Controller
{
    // 商品一覧画面表示
    public function index()
    {
        $products = Product::with('seasons')->get();
        return view('index', compact('products'));
    }
    // 商品検索
    public function search(Request $request)
    {
        return view('admin');
    }
    // 商品詳細画面表示
    public function show(Request $request)
    {
        return view('admin', compact('products'));
    }
    // 商品変更
    public function update(ProductRequest $request)
    {
        return redirect('index');
    }
    // 商品削除
    public function destroy(Request $request)
    {
        Product::find($request->id)->delete();
        return redirect('index');
    }
    // 商品登録画面表示
    public function create(ProductRequest $request)
    {
        return view('register');
    }
    // 商品登録
    public function store()
    {
        return redirect('index');
    }
}
