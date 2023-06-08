<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class PostsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => "required",
            'house_type' => "required",
            'house_kind' => "required",
            'desciption' => "required",
            'city' => "required",
            'district' => "required", 
            'commune' => "required",
            'price' => "required",
            'size' => "required",         
        ];
    } 

    public function messages(){
        return [
            'required' => "Trường :attribute không được để trống",
        ];
    }

    public function attributes(){
        return [
            'title' => 'tiêu đề',
            'desciption' => 'mô tả',
            'house_type' => 'loại tin',
            'house_kind' => 'loại bất động sản',
            'city' => 'tỉnh, thành phố',
            'district' => 'quận, huyện',
            'commune' => 'phường, xã',
            'price' => 'giá',
            'size' => 'diện tích', 
        ];
    }
}
