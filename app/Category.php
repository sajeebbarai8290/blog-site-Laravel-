<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =['categoryName','categoryDescription','publicationStatus'];
    
    public static function saveCategoryInfo($request){
        $category = new Category();
        $category->categoryName         = $request->categoryName;
        $category->categoryDescription  = $request->categoryDescription;
        $category->publicationStatus    = $request->publicationStatus;
        $category->save();
    }
    public static function updateCategoryInfo($request){
        $category = Category::find($request->id);
        $category->categoryName          =  $request->categoryName;
        $category->categoryDescription   =  $request->categoryDescription;
        $category->publicationStatus     =  $request->publicationStatus;
        $category->save();
    }
}
