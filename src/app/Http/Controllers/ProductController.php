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
    public function show(Request $request, $productId)
    {
        $seasons = Season::all();
        $product = Product::findOrFail($productId);

        return view('admin', compact('product', 'seasons'));
    }
    // 商品変更
    public function update(ProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        // 画像がアップロードされた場合、画像を保存
        if ($request->hasFile('image')){
            // 画像ファイルを取得
            $image = $request->file('image');
            // アップロードファイルの名前を取得
            $file_name = $image->getClientOriginalName();

            // 画像をimagesディレクトリに保存
            $dir = 'images/products';
            $image->storeAs($dir, $file_name, 'public');
            // 新しい画像名を保存
            $product->image= $file_name;
        }

        $product->save();
        // 季節の更新
        $product->seasons()->sync($request->input('season'));

        return redirect()->route('products.index');
    }
    // 商品削除
    public function destroy(Request $request)
    {
        Product::find($request->id)->delete();
        return redirect()->route('products.index');
    }
    // 商品登録画面表示
    public function create()
    {
        $seasons = Season::all();
        $product = new Product();

        return view('register', compact('seasons', 'product'));
    }
    // 商品登録
    public function store(ProductRequest $request)
    {
        // 画像ファイルを取得
        $image = $request->file('image');
        // アップロードファイルの名前を取得
        $file_name = $image->getClientOriginalName();

        // 画像をimagesディレクトリに保存
        $dir = 'images/products';
        $image->storeAs($dir, $file_name, 'public');

        // 商品をデータベース・storageディレクトリに保存
        $product = new Product();
        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image' => $file_name,
        ]);
        $product->save();

        // 中間テーブルに季節情報を保存
        $product->seasons()->attach($request->input('season'));

        return redirect()->route('products.index');
    }
}
