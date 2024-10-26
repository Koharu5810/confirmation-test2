<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required | string | unique:products,name',
            'price' => 'required | integer | between:0,10000',
            'image' => 'required | string | mimes:png,jpg | max:2048',   // maxはファイルサイズ上限。適宜変更
            'description' => 'required | string | max:120',
            'season' => 'required | string | unique:seasons,name',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.integer' => '数値で入力してください',
            'price.between' => '0〜10000円以内で入力してください',
            'image.required' => '商品画像を登録してください',
            'image.mimes' => '「.png」または「.jpg」形式でアップロードしてください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
            'season.required' => '季節を選択してください',
        ];
    }
}
