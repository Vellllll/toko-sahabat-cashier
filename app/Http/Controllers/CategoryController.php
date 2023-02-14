<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Category;

use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    public function categoryListPage(){
        $category_list = Category::orderBy('id', 'desc')->get();
        return view('category.category_list')->with([
            'category_list' => $category_list
        ]);
    }

    public function addCategoryPage(){
        return view('category.add_category');
    }

    public function addCategory(Request $request){
        $request->validate([
            'category_name' => 'required|unique:categories,category_name'
        ],[
            'category_name.unique' => 'This category has already added!'
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Category added!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function editCategoryPage($id){
        $category = Category::findOrFail($id);

        return view('category.edit_category')->with([
            'category' => $category
        ]);
    }

    public function editCategory(Request $request, $id){
        $category = Category::find($id);

        $category->update([
            'category_name' => $request->category_name,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Category updated!',
            'alert-type' => 'success'
        );

        return redirect()->route('category.list.page')->with($notification);
    }

    public function deleteCategory($id){
        $category = Category::findOrFail($id);

        $category->delete();

        $notification = array(
            'message' => 'Category deleted!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
