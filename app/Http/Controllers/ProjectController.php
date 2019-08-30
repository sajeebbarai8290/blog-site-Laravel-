<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Category;
use App\Comment;
use App\Visitor;
use DB;

class ProjectController extends Controller
{
    public function index(){
        $blogs = Blog::where('publicationStatus',1)->orderBy('id','desc')->take(3)->get();
        $categories = Category::where('publicationStatus',1)->get();
        
        return view('front.home.home',[
            'blogs'      =>$blogs,
            'categories' => $categories,
            'popularBlogs' => Blog::orderBy('hitCount','desc')->take(2)->get()
        ]);
    }
    public function categoryBlog($id,$name){
        $categories = Category::where('publicationStatus',1)->get();
        $blogs = Blog::where('categoryId',$id)->where('publicationStatus',1)->get();
        return view('front.category.category-blog',[
            'categories'=> $categories,
            'blogs'      => $blogs
        ]);
    }
    public function blogDetails($id){
        $categories = Category::where('publicationStatus',1)->get();
        $blog       = Blog::find($id);
        $blog->hitCount = $blog->hitCount +1;
        $blog->save();
        $comments   = DB::table('comments')
                        ->join('visitors', 'comments.visitorId','=','visitors.id')
                        ->select('comments.*','visitors.firstName','visitors.lastName')
                        ->where('comments.blogId',$id)
                        ->where('comments.publicationStatus',1)
                        ->orderBy('comments.id','desc')
                        ->get();
        return view('front.blog.blog-details',[
            'categories'   =>  $categories,
            'blog'         => Blog::find($id),
            'comments'     =>  $comments
        ]);
    }
}
