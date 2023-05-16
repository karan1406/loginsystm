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
            'status' => 'required',
            'slug' => 'required|unique:categories,slug'
        ]);

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
            'status' => 'required',
            'slug' => ['required',Rule::unique('categories','slug')->ignore($category->id)]
        ]);
        $category->update($attribute);
        session()->flash('success', "Category Updated");

    }
}
