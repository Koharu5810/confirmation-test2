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
        $products = Product::with('seasons')->paginate(6);

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
        // 商品を取得
        $product = Product::findOrFail($productId);

        // 基本情報の更新
        $product->update($request->only([
            'name',
            'price',
            'description',
        ]));

        // 画像がアップロードされた場合、画像を保存
        if ($request->hasFile('image')){
            // 画像ファイルを取得
            $image = $request->file('image');
            // アップロードファイルの名前を取得
            $file_name = time() . '_' . $image->getClientOriginalName();

            // 画像をimagesディレクトリに保存
            $dir = 'images/products';
            $image->storeAs($dir, $file_name, 'public');

            // 元の画像ファイルの削除
            if ($product->image) {
                $oldImagePath = public_path('storage/images/products/' . $product->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // 新しい画像名を保存
            $product->image = $file_name;
        }

        // 変更を保存
        $product->save();
        // 季節の更新
        $product->seasons()->sync($request->input('season'));

        return redirect()->route('products.index');
    }
// 商品削除
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        // 中間テーブルのデータをクリア
        $product->seasons()->detach();

        // 画像ファイルの削除
        if ($product->image) {
            $imagePath = public_path('storage/images/products/' . $product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $product->delete();

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
            'image' => 'images/products/' . $file_name,
        ]);
        $product->save();

        // 中間テーブルに季節情報を保存
        $product->seasons()->attach($request->input('season'));

        return redirect()->route('products.index');
    }
}
