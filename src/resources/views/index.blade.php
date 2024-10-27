{{-- 商品一覧画面 --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="container">
{{-- メインコンテンツヘッダー部分 --}}
    <div class="search-header">
        <h3 class="search-header__info">商品一覧</h3>
        <div class="create-button">
            <a href="{{ route('products.register') }}">+ 商品を追加</a>
        </div>
    </div>
    <div class="layout">
{{-- サイドバー --}}
        <div class="sidebar">
            <form class="search" action="" method="post">
                @csrf
                <div class="search__form">
                    <input type="text" placeholder="商品名で検索">
                </div>
                <button class="search__button">検索</button>
            </form>
            <form class="sort" action="" method="get">
                @csrf
                <label class="sort__title">価格順で表示</label>
                <select name="">
                    <option selected deisable>価格で並べ替え</option>
                    <option value="">高い順に表示</option>
                    <option value="">安い順に表示</option>
                </select>
            </form>
        </div>
    {{-- 一覧画面 --}}
        <div class="products">
            <div class="product-listing">
                @foreach($products as $product)
                    <div class="product-item">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="display: block;" />
                        <div class="product-explanation">
                            <div class="product-name">
                                {{ $product->name }}
                            </div>
                            <div class="product-price">
                                &yen;{{ $product->price }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        {{-- ページネーション --}}
            <div class="pagination">
                <a href="#">1</a>
                <a href="#" class="active">2</a>
                <a href="#">3</a>
            </div>
        </div>
    </div>
</div>
@endsection
