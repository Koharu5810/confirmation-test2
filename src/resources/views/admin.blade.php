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
            <a href="{{ route('products.index') }}">商品一覧</a>
            &nbsp;>&nbsp;{{ $product->name }}
        </div>
    {{-- 画像選択 --}}
        <div class="form-top">
            <div class="form-image">
                <img id="imagePreview" src="" alt="商品画像" style="display: none;" />
                <input type="file" name="image" accept="image/*" class="form-image__button" onchange="previewImage(event)"/>
            </div>
            <div class="form__error">
                @if($errors->has('image'))
                    @foreach($errors->get('image') as $message)
                        <span>{{ $message }}</span>
                    @endforeach
                @endif
            </div>
            <div class="form-detail">
            {{-- 商品名 --}}
                <div class="form-group">
                    <label for="name">商品名</label>
                    <div class="form-group__input">
                        <input type="text" name="name" placeholder="商品名を入力" value="{{ $product->name, old('name') }}" />
                    </div>
                    <div class="form__error">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            {{-- 値段 --}}
                <div class="form-group">
                    <label for="price">値段</label>
                    <div class="form-group__input">
                        <input type="text" name="price" placeholder="値段を入力" value="{{ $product->price, old('price') }}" />
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
                <div class="form-group">
                    <label for="season">季節</label>
                    <div class="check-group">
                        @foreach($seasons as $season)
                            <label>
                                <input type="checkbox" name="season[]" value="{{ $season->id }}"
                                @if(in_array($season->id, old('season', []))) checked @endif />
                                {{ $season->name }}
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
        <div class="form-group">
            <div class="form-group__input">
                <label for="description">商品説明</label>
            </div>
            <textarea name="description" placeholder="商品の説明を入力">{{ $product->description, old('description') }}</textarea>
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
            <a class="form__button-return" href="{{ route('products.index') }}">戻る</a>
            <input class="form__button-update" type="submit" value="変更を保存" name="send" />
            <input class="form__button-delete" type="submit" value="" /><img src="{{ asset('storage/images/products/trush_icon.png') }}" alt="削除">
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const imagePreview = document.getElementById('imagePreview');
    const file = event.target.files[0]; // 選択されたファイルを取得

    if (file) {
        const reader = new FileReader(); // FileReaderオブジェクトを作成

        // ファイルの読み込みが完了した際の処理
        reader.onload = function(e) {
            imagePreview.src = e.target.result; // 読み込んだデータをimgタグのsrcに設定
            imagePreview.style.display = 'block'; // imgを表示
        }

        reader.readAsDataURL(file); // 選択されたファイルをDataURLとして読み込む
    } else {
        imagePreview.src = ''; // ファイルが選択されていない場合、srcを空にする
        imagePreview.style.display = 'none'; // imgを非表示
    }
}
</script>

@endsection


