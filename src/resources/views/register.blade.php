{{-- 商品登録画面 --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('content')
<div class="container">
    <form class="form" action="/products/register" method="post" enctype="multipart/form-data">
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
                <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}" />
            </div>
            <div class="form__error">
                @error('name')
                {{ $message }}
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
                <input type="text" name="price" placeholder="値段を入力" value="{{ old('price') }}" />
            </div>
            @if($errors->has('price'))
                <ul class="form__error">
                    @foreach($errors->get('price') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    {{-- 画像選択 --}}
        <div class="form-group">
            <div class="form-title">
                <label for="image">商品画像</label>
                <div class="form-required">必須</div>
            </div>
            <div class="form-image">
                <img id="imagePreview" src="" alt="商品画像" style="display: none;" />
                <input type="file" name="image" accept="image/*" class="form-image__button" onchange="previewImage(event)"/>
            </div>
            @if($errors->has('image'))
                <ul class="form__error">
                    @foreach($errors->get('image') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    {{-- 季節 --}}
        <div class="form-group">
            <div class="form-title">
                <label for="season">季節</label>
                <div class="form-required">必須</div>
                <div class="check-text">複数選択可</div>
            </div>
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
    {{-- 商品説明入力 --}}
        <div class="form-group">
            <div class="form-group__input">
                <div class="form-title">
                    <label for="description">商品説明</label>
                    <div class="form-required">必須</div>
                </div>
            </div>
            <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            <div class="form__error">
            @if($errors->has('description'))
                <ul class="form__error">
                    @foreach($errors->get('description') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
            </div>
        </div>
    {{-- フォームボタン --}}
        <div class="form__button">
            <a class="form__button-return" href="{{ route('products.index') }}">戻る</a>
            <input class="form__button-create" type="submit" value="登録" name="send" />
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
