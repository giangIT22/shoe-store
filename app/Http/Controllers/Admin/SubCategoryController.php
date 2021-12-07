<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        $page = (int) $request->page ?? 1;
        $data = SubCategory::with('category')->orderBy('created_at', 'desc')->get();
        $subCategories = $data->forPage($page, 10);
        $lastPage = ceil(count($data) / SubCategory::PER_PAGE);

        return view('admin.category.subcategory.view', [
            'subCategories' => $subCategories,
            'lastPage' => $lastPage,
            'total' => count($data)
        ]);
    }

    public function create()
    {
        $categories = Category::get();

        return view('admin.category.subcategory.create_subcategory', compact('categories'));
    }

    public function store(SubCategoryRequest $request)
    {
        SubCategory::create($request->all());

        $notification = [
            'message' => 'Create subcategory successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.sub_categories')->with($notification);
    }

    public function edit($subCategoryId)
    {
        $categories = Category::get();
        $subCategory = SubCategory::findOrFail($subCategoryId);

        return view('admin.category.subcategory.update_subcategory', compact('subCategory', 'categories'));
    }

    public function update(SubCategoryRequest $request, $subCategoryId)
    {
        $subCategory = SubCategory::findOrFail($subCategoryId);
        $subCategory->sub_category_name = $request->sub_category_name;
        $subCategory->sub_category_slug = $request->sub_category_slug;
        $subCategory->category_id = $request->category_id;

        $subCategory->save();

        $notification = [
            'message' => ' Subcategory have updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.sub_categories')->with($notification);
    }

    public function delete($subCategoryId)
    {
        try {
            SubCategory::findOrFail($subCategoryId)->delete();
            return response()->json([
                'code' => 200,
                'status' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 200,
                'status' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
