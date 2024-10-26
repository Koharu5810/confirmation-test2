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
        <div class="search-header__button">
            <button class="addition-button">+ 商品を追加</button>
        </div>
    </div>
    <div class="layout">
{{-- サイドバー --}}
        <div class="sidebar">
            <div class="search">
                <div class="search__form">
                    <input type="text" placeholder="商品名で検索">
                </div>
                <button class="search__button">検索</button>
            </div>
            <div class="sort">
                <p class="sort__title">価格順で表示</p>
                <select name="">
                    <option selected deisable>価格で並べ替え</option>
                    <option value="">高い順に表示</option>
                    <option value="">安い順に表示</option>
                </select>
            </div>
        </div>
    {{-- 一覧画面 --}}
        <div class="product-listing">
            <div class="product-item">
                <img src="storage/images/products/kiwi.png" alt="キウイ">
                <div class="product-explanation">
                    <div class="product-name">キウイ</div>
                    <div class="product-price">¥800</div>
                </div>
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
