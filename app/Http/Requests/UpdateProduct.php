<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduct extends FormRequest
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
            'name' => ['required', 'unique:products,name,' . $this->product_id],
            // 'product_price' => 'required|numeric'            
            'category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập trường này',            
            'category_id.required' => 'Vui lòng nhập trường này',
            // 'product_price.required' => 'Vui lòng nhập trường này',
            // 'product_price.numeric' => 'Giá tiền phải là số',
        ];
    }
}
