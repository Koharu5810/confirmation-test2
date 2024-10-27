<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private const IMAGE_DIR = 'images/products';

// 商品一覧画面表示
    public function index(Request $request)
    {
        $products = $this->applySearchAndSort($request, Product::query())->paginate(6);

        return view('index', [
            'products' => $products,
            'sortOrder' => $request->input('sort') ?? null,
        ]);
    }
// 商品検索
    public function search(Request $request)
    {
        return $this->index($request);
    }
// 検索とソート処理の共通化
    private function applySearchAndSort(Request $request, $query)
    {
        // 検索
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }
        // ソート
        if ($request->filled('sort')) {
            $sortOrder = $request->input('sort') === 'high' ? 'desc' : 'asc';
            $query->orderBy('price', $sortOrder);
        }

        return $query;
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

        $product->update($request->only(['name', 'price', 'description']));

        // 画像ファイルの更新
        if ($request->hasFile('image')) {
            $this->deleteImage($product->image);
            $product->image = $this->saveImage($request->file('image'));
        }

        $product->save();
        // 中間テーブルに挿入
        $product->seasons()->sync($request->input('season'));

        return redirect()->route('products.index');
    }
// 商品削除
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        // 中間テーブルの四季情報を削除
        $product->seasons()->detach();
        // 画像ファイルをストレージから削除
        $this->deleteImage($product->image);
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
        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image' => $this->saveImage($request->file('image')),
        ]);

        $product->seasons()->attach($request->input('season'));

        return redirect()->route('products.index');
    }

// 画像保存処理
    private function saveImage($image)
    {
        // ディレクトリ保存時の画像ファイル名生成
        $fileName = time() . '_' . $image->getClientOriginalName();
        // 画像ファイルを定数IMAGE_DIRで設定したディレクトリに保存
        // 'public'はシンボリックリンクに関わる
        $image->storeAs(self::IMAGE_DIR, $fileName, 'public');

        return self::IMAGE_DIR . '/' . $fileName;
    }
// 画像削除処理
    private function deleteImage($imagePath)
    {
        // 画像ファイルのパスを確認
        if ($imagePath && file_exists(public_path('storage/' . $imagePath))) {
            @unlink(public_path('storage/' . $imagePath));
        }
    }
}
