<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Blog;
class CategoryController extends Controller
{
    public function addCategory(){
        return view('admin.category.add-category');
    }
    public function newCategory(Request $request){
        $this->validate($request,[
            'categoryName'=>'required',
            'categoryDescription'=>'required'
        ]);
        Category::saveCategoryInfo($request);
        return redirect('/category/add-category')->with('message','Category Info Save Successfully');
    }
    public function manageCategory(){
        $categories = Category::all();
        return view('admin.category.manage-category',['categories'=>$categories]);
    }
    public function editCategory($id){
        $category = Category::find($id);
        return view('admin.category.edit-category',['category'=>$category]);
    }
    public function updateCategory(Request $request){
        Category::updateCategoryInfo($request);
        return redirect('/category/manage-category')->with('message','Category Info Update Successfully');
    }
    public function deleteCategory(Request $request){
        $blog = Blog::where('categoryId',$request->id)->first();
        if($blog){
            return redirect('/category/manage-category')->with('message','sorry we can not delete this category because some blog are available in this category!'); 
        }else{
            $category = Category::find($request->id);
            $category->delete();
            return redirect('/category/manage-category')->with('message','Category Info Delete Successfully'); 
        }
        
    }
}
