<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryService implements CategoryServiceInterface
{
    public function getCategories()
    {
        $data = Category::where('deleted_at', null)->orderBy('created_at', 'desc')->get();

        return $data;
    }

    public function saveCategories($params)
    {
        $data = Category::create($params);

        return $data;
    }

    public function updateCategory($categoryId, $params)
    {
        $category = Category::findOrFail($categoryId);
        $category->name = $params['name'];

        $category->save();

        return $category;
    }

    public function getInfoCategory($categoryId)
    {
        $data = Category::findOrFail($categoryId);

        return $data;
    }

    public function validateStoreCategory($params = [])
    {
        $validate = Validator::make($params, [
            'name' => ['required', 'string', 'unique:categories,name,' . $params['category_id']],
        ]);

        if ($validate->fails()) {
            return [false, $validate->errors()];
        }

        return [true, $validate->errors()];
    }

    public function deleteCategory($categoryId)
    {
        $data = Category::findOrFail($categoryId)->delete();

        return $data;
    }

    public function searchCategory($params)
    {
        $dataSearch = Category::search($params)->paginate(Category::PER_PAGE);

        return [
            'categories' => $dataSearch->items(),
            'lastPage' => $dataSearch->lastPage()
        ];
    }
}
