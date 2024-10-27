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
            <form class="form" action="{{ route('products.search') }}" method="get">
                <div class="search__form">
                    <input type="text" name="search" placeholder="商品名で検索" value="{{ request('search') }}">
                </div>
                <button type="submit" class="search__button">検索</button>
                <label class="sort__title" for="sort">価格順で表示</label>
                <select name="sort" class="sort-list" onchange="this.form.submit()">
                    <option value="" disabled {{ request('sort') === null ? 'selected' : '' }}>価格で並べ替え</option>
                    <option value="high" {{ request('sort') === 'high' ? 'selected' : '' }}>高い順に表示</option>
                    <option value="low" {{ request('sort') === 'low' ? 'selected' : '' }}>安い順に表示</option>
                </select>
        {{-- 並び替えタグ表示 --}}
            @if (!empty($sortOrder) && ($sortOrder === 'high' || $sortOrder === 'low'))
                <div class="sort-tag">
                    <span>{{ $sortOrder === 'high' ? '高い順に表示' : '安い順に表示' }}</span>
                    <a href="{{ route('products.index', ['search' => request('search')]) }}" class="clear-sort">✕</a>
                </div>
            @endif
            </form>
        </div>
{{-- 一覧画面 --}}
        <div class="products">
            <div class="product-listing">
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                        <a href="{{ route('products.show', ['productId' => $product->id]) }}" class="product-item-link">
                            <div class="product-item">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                                <div class="product-explanation">
                                    <div class="product-name">
                                        {{ $product->name }}
                                    </div>
                                    <div class="product-price">
                                        &yen;{{ $product->price }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p>該当の商品が見つかりませんでした。</p>
                @endif
            </div>
        {{-- ページネーション --}}
            <div class="pagination">
                {{ $products->links('vendor.pagination.semantic-ui') }}
            </div>
        </div>
    </div>
</div>
@endsection
