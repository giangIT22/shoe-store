<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => ['required', 'unique:categories,name,' . $this->category_id],
            'slug' => ['required', 'unique:categories,slug,' . $this->category_id],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên danh mục',
            'slug.required' => 'Vui lòng nhập slug',
            'name.unique' => 'Tên danh mục đã bị trùng',
            'slug.unique' => 'Slug đã bị trùng'
        ];
    }
}
