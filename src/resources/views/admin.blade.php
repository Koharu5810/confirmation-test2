{{-- 商品詳細・変更画面 --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('content')
<div class="container">
    <form class="form" action="" method="post">
        @csrf
        <div class="breadcrumb">
            <a href="">商品一覧</a>
            &nbsp;>&nbsp;キウイ
        </div>
    {{-- 画像選択 --}}
        <div class="form-top">
            <div class="form-img">
                {{-- <img src="storage/images/products/kiwi.png" alt=""> --}}
                <div class="form-image__select">
                    <button class="form-image__button">ファイルを選択</button>
                    <div class="form-image__filename">kiwi.png</div>
                </div>
                <div class="form__error">
                    @error('')
                    {{$message}}
                    @enderror
                </div>
            </div>
            <div class="form-detail">
            {{-- 商品名 --}}
                <div class="form-group">
                    <label for="name">商品名</label>
                    <div class="form-group__input">
                        <input type="text" name="" placeholder="商品名を入力" value="{{old('name')}}" />
                    </div>
                    <div class="form__error">
                        @error('')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            {{-- 値段 --}}
                <div class="form-group">
                    <label for="price">値段</label>
                    <div class="form-group__input">
                        <input type="number" name="" placeholder="値段を入力" value="{{old('price')}}" />
                    </div>
                    <div class="form__error">
                        @error('')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            {{-- 季節 --}}
                <div class="form-group">
                    <label for="season">季節</label>
                    <div class="check-group">
                        <label><input type="checkbox" name="season" value="">春</label>
                        <label><input type="checkbox" name="season" value="">夏</label>
                        <label><input type="checkbox" name="season" value="">秋</label>
                        <label><input type="checkbox" name="season" value="">冬</label>
                    </div>
                    <div class="form__error">
                        @error('')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    {{-- 商品説明入力 --}}
        <div class="form-group">
            <div class="form-group__input">
                <label for="description">商品説明</label>
            </div>
            <textarea name="description" placeholder="商品の説明を入力">{{old('')}}</textarea>
            <div class="form__error">
                @error('')
                {{$message}}
                @enderror
            </div>
        </div>
    {{-- フォームボタン --}}
        <div class="form__button">
            <button class="form__button-return" type="">戻る</button>
            <button class="form__button-update" type="">変更を保存</button>
            <button class="form__button-delete" type="">消</button>
        </div>
    </form>
</div>
@endsection
