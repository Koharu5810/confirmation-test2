{{-- 商品登録画面 --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('content')
<div class="product-register__container">
    <form class="form" action="/products/register" method="post" enctype="multipart/form-data">
        @csrf
        <div class="product-register__title">
            <h3>商品登録</h3>
        </div>
    {{-- 商品名 --}}
        <div class="form__group">
            <div class="form__label">
                <label for="name">商品名</label>
                <div class="form__required">必須</div>
            </div>
            <div class="form__group-input">
                <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}" />
            </div>
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
        </div>
    {{-- 値段 --}}
        <div class="form__group">
            <div class="form__label">
                <label for="price">値段</label>
                <div class="form__required">必須</div>
            </div>
            <div class="form__group-input">
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
        <div class="form__group">
            <div class="form__label">
                <label for="image">商品画像</label>
                <div class="form__required">必須</div>
            </div>
            <div class="form__image">
                <img id="imagePreview" src="" alt="商品画像" style="display: none; max-width:300px;" />
                <input type="file" name="image" accept="image/*" class="form__image-button" onchange="previewImage(event)" />
                <input type="hidden" name="temp_image" value="{{ session('uploaded_image') }}" />
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
        <div class="form__group">
            <div class="form__label">
                <label for="season">季節</label>
                <div class="form__required">必須</div>
                <div class="form__check-text">複数選択可</div>
            </div>
            <div class="form__check-group">
                @foreach($seasons as $season)
                    <label class="custom-checkbox">
                        <input type="checkbox" name="season[]" value="{{ $season->id }}" class="custom-checkbox__input"
                        @if(in_array($season->id, old('season', []))) checked @endif />
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
    {{-- 商品説明入力 --}}
        <div class="form__group">
            <div class="form__label">
                <label for="description">商品説明</label>
                <div class="form__required">必須</div>
            </div>
            <div class="form__group-input">
                <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            </div>
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
            <a class="form__button-common form__return-button" href="{{ route('products.index') }}">戻る</a>
            <input class="form__button-common form__create-button" type="submit" value="登録" name="send" />
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0]; // 選択されたファイルを取得

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    }
</script>

@endsection
