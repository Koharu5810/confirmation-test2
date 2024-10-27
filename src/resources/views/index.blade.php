{{-- 商品一覧画面 --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="container">
{{-- メインコンテンツヘッダー部分 --}}
    <div class="product-list__header">
        <h3 class="product-list__header__info">商品一覧</h3>
        <a href="{{ route('products.register') }}" class="product-list__add-button">+ 商品を追加</a>
    </div>
    <div class="product-list__layout">
{{-- サイドバー --}}
        <div class="sidebar">
            <form class="sidebar__form" action="{{ route('products.search') }}" method="get">
            {{-- 検索フォーム --}}
                <div class="sidebar__search-form">
                    <input type="text" name="search" placeholder="商品名で検索" value="{{ request('search') }}">
                </div>
                <button type="submit" class="search__button">検索</button>
            {{-- ソートフォーム --}}
                <div class="sidebar__sort-form">
                    <label class="sidebar__sort-title" for="sort">価格順で表示</label>
                    <select name="sort" class="sidebar__sort-list" onchange="this.form.submit()">
                        <option value="" disabled {{ request('sort') === null ? 'selected' : '' }}>価格で並べ替え</option>
                        <option value="high" {{ request('sort') === 'high' ? 'selected' : '' }}>高い順に表示</option>
                        <option value="low" {{ request('sort') === 'low' ? 'selected' : '' }}>安い順に表示</option>
                    </select>
        {{-- 並び替えタグ表示 --}}
                    @if (!empty($sortOrder) && ($sortOrder === 'high' || $sortOrder === 'low'))
                        <div class="sidebar__sort-tag">
                            <span>{{ $sortOrder === 'high' ? '高い順に表示' : '安い順に表示' }}</span>
                            <a href="{{ route('products.index', ['search' => request('search')]) }}" class="sidebar__clear-sort">✕</a>
                        </div>
                    @endif
                </div>
            </form>
        </div>
{{-- 一覧画面 --}}
        <div class="products">
            <div class="product-list">
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                        <a href="{{ route('products.show', ['productId' => $product->id]) }}" class="product-item-link">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                                <div class="product-item__explanation">
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
