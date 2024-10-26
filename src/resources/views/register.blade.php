{{-- 商品登録画面 --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('content')
<div class="container">
    <form class="form" action="" method="post">
        @csrf
        <div class="register-info">
            <h3>商品登録</h3>
        </div>
    {{-- 商品名 --}}
        <div class="form-group">
            <div class="form-title">
                <label for="name">商品名</label>
                <div class="form-required">必須</div>
            </div>
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
            <div class="form-title">
                <label for="price">値段</label>
                <div class="form-required">必須</div>
            </div>
            <div class="form-group__input">
                <input type="number" name="" placeholder="値段を入力" value="{{old('price')}}" />
            </div>
            <div class="form__error">
                @error('')
                {{$message}}
                @enderror
            </div>
        </div>
    {{-- 画像選択 --}}
        <div class="form-group">
            <div class="form-title">
                <label for="image">商品画像</label>
                <div class="form-required">必須</div>
            </div>
            {{-- <img src="storage/images/products/kiwi.png" alt=""> --}}
            <div class="form-image__select">
                <button class="form-image__button">ファイルを選択</button>
                {{-- <div class="form-image__filename">kiwi.png</div> --}}
            </div>
            <div class="form__error">
                @error('')
                {{$message}}
                @enderror
            </div>
        </div>
    {{-- 季節 --}}
        <div class="form-group">
            <div class="form-title">
                <label for="season">季節</label>
                <div class="form-required">必須</div>
                <div class="check-text">複数選択可</div>
            </div>
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
    {{-- 商品説明入力 --}}
        <div class="form-group">
            <div class="form-group__input">
                <div class="form-title">
                    <label for="description">商品説明</label>
                    <div class="form-required">必須</div>
                </div>
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
        </div>
    </form>
</div>
@endsection
