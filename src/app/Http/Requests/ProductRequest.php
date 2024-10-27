<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
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
        $rules = [
            'name' => 'required|string|unique:products,name' . ($this->isMethod('patch') ? ',' . $this->route('productId') : ''),
            'price' => 'required|integer|between:0,10000',
            'description' => 'required|string|max:120',
            'season' => 'required|array|unique:seasons,name',
        ];

        // storeメソッド（画像ファイルを必須）
        if ($this->isMethod('post')){
            $rules['image'] = 'required|mimes:png,jpg,jpeg';
        }
        // patchメソッド（画像ファイルを任意）
        if ($this->isMethod('patch')){
            $rules['image'] = 'nullable|mimes:png,jpg,jpeg';
        }

        return $rules;
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
