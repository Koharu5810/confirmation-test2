{{-- 商品詳細・変更画面 --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('content')
<div class="container">
    <form class="form" action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')  {{-- 商品変更のためのメソッド --}}
        <div class="breadcrumb">
            <a href="{{ route('products.index') }}">商品一覧</a>
            &nbsp;>&nbsp;{{ $product->name }}
        </div>
    {{-- 画像選択 --}}
        <div class="form__top">
            <div class="form__image">
                <img id="imagePreview"
                src="{{ session('uploaded_image') ? asset('storage/' . session('uploaded_image')) : (isset($product->image) ? asset('storage/' . $product->image) : '') }}"
                alt="{{ $product->name }}"
                style="{{ session('uploaded_image') || isset($product->image) ? 'display: block;' : 'display: none;' }}" />
                @if (session()->has('uploaded_image'))
                    {{ session()->forget('uploaded_image') }}
                @endif
                <input type="file" name="image" accept="image/*" class="form__image__button" onchange="previewImage(event)"/>
                @if (session()->has('uploaded_image_name'))
                    {{ session()->forget('uploaded_image_name') }}
                @endif
            </div>
            <div class="form__error">
                @if($errors->has('image'))
                    @foreach($errors->get('image') as $message)
                        <span>{{ $message }}</span>
                    @endforeach
                @endif
            </div>
            <div class="form__detail">
            {{-- 商品名 --}}
                <div class="form__group">
                    <label for="name" class="form__label">商品名</label>
                    <div class="form__group-input">
                        <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name', $product->name) }}" />
                    </div>
                    <div class="form__error">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            {{-- 値段 --}}
                <div class="form__group">
                    <label for="price" class="form__label">値段</label>
                    <div class="form__group-input">
                        <input type="text" name="price" placeholder="値段を入力" value="{{ old('price', $product->price) }}" />
                    </div>
                    <div class="form__error">
                        @if($errors->has('price'))
                            @foreach($errors->get('price') as $message)
                                <span>{{ $message }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            {{-- 季節 --}}
                <div class="form__group">
                    <label for="season" class="form__label">季節</label>
                    <div class="form__check-group">
                        @foreach($seasons as $season)
                            <label class="custom-checkbox">
                                <input type="checkbox" name="season[]" value="{{ $season->id }}" class="custom-checkbox__input"
                                @if($product->seasons->contains($season->id)) checked @endif />
                                <span class="custom-checkbox__circle"></span>
                                <span class="custom-checkbox__label">{{ $season->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    <div class="form__error">
                        @error('season')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    {{-- 商品説明入力 --}}
        <div class="form__group">
            <label for="description" class="form__label">商品説明</label>
            <div class="form__group-input">
                <textarea name="description" placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="form__error">
                @if($errors->has('description'))
                    @foreach($errors->get('description') as $message)
                        <span>{{ $message }}</span>
                    @endforeach
                @endif
            </div>
        </div>
    {{-- フォームボタン --}}
        <div class="form__button">
            <a class="form__button-common form__return-button" href="{{ route('products.index') }}">戻る</a>
            <input class="form__button-common form__update-button" type="submit" value="変更を保存" name="send" />
        </div>
    </form>
    @if(!$errors->any())
        <div class="form__delete">
            <form action="{{ route('products.destroy', $product->id) }}" method="post" style="display: inline;">
                @csrf
                @method('DELETE')
                <button class="form__delete-button" type="submit">
                    <img src="{{ asset('storage/images/products/trush_icon.png') }}" alt="削除">
                </button>
            </form>
        </div>
    @endif
</div>

<script>
function previewImage(event) {
    const imagePreview = document.getElementById('imagePreview');
    const file = event.target.files[0]; // 選択されたファイルを取得

    if (file) {
        const reader = new FileReader(); // FileReaderオブジェクトを作成
        // ファイルの読み込みが完了した際の処理
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';  // プレビューを表示
            // imagePreview.src = e.target.result; // 読み込んだデータをimgタグのsrcに設定
        }
        reader.readAsDataURL(file); // 選択されたファイルをDataURLとして読み込む

    } else {
        imagePreview.src = ''; // ファイルが選択されていない場合、srcを空にする
    }
}
</script>

@endsection
