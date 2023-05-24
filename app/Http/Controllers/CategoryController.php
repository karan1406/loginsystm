<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;


class CategoryController extends Controller
{
    public function create()
    {
        return view('category.category',[
            'categories' => Category::all(),
        ]);
    }

    public function store()
    {
        $attribute = request()->validate([
            'name' => 'required|unique:categories,name',
            'slug' => 'required|unique:posts,slug|unique:categories,slug|regex:/(^[a-zA-Z-]+[a-zA-Z-]*$)/u'
        ]);
        $attribute['status'] = 0;
        $attribute['user_id'] = auth()->id();
        Category::create($attribute);
        session()->flash('success', "Category Added");
    }
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', "Category Deleted");
    }
    public function update(Category $category)
    {
        $attribute = request()->validate([
            'name' => ['required',Rule::unique('categories','name')->ignore($category->id)],
            'slug' => 'required|unique:posts,slug|unique:categories,slug,'.$category->id,

        ]);
        $category->update($attribute);
        session()->flash('success', "Category Updated");

    }

    public function updateStatus(Category $category)
    {
        // dd($category);
        $data = ['status' => request()->status];
        $category->update($data);
        session()->flash('success', "Status Updated");

    }
}
