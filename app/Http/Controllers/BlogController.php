<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Blog;
use DB;
use App\Comment;
class BlogController extends Controller
{
    
    public function addBlog(){
        $categories = Category::where('publicationStatus',1)->get();
        return view('admin.blog.add-blog',[
            'categories'=>$categories
        ]);
    }
    
    private function imageUpload($image){
        $imageName = $image->getClientOriginalName();
        $directory = 'blog-images/';
        $image->move($directory,$imageName);
        return $directory.$imageName;
    }

    public function newBlog(Request $request){
        
        
        $blog = new Blog();
        $blog->categoryId = $request->categoryId;
        $blog->blogTitle = $request->blogTitle;
        $blog->blogShortDescription = $request->blogShortDescription;
        $blog->blogLongDescription = $request->blogLongDescription;
        $blog->blogImage = $this->imageUpload($request->file('blogImage'));
        $blog->publicationStatus = $request->publicationStatus;
        $blog->save();
        
        return redirect('/blog/add-blog')->with('message','Blog info created successfully');
    }
    public function manageBlog(){
        $blogs = DB::table('blogs')
                ->join('categories','blogs.categoryId','=','categories.id')
                ->select('blogs.*','categories.categoryName')
                ->orderBy('blogs.id','desc')
                ->get();
        return view('admin.blog.manage-blog',[
            'blogs'=> $blogs
        ]);
    }
    public function editBlog($id){
        return view('admin.blog.edit-blog',[
            'categories'=> Category::where('publicationStatus',1)->get(),
            'blog'      => Blog::find($id)
        ]);
    }
    public function updateBlog(Request $request){
        $blog = Blog::find($request->id);
        $image = $request->file('blogImage');
        if($image){
            
            
            unlink($blog->blogImage);
            
            $imagePath = $this->imageUpload($image);
            
            
            
        }
        $blog->categoryId = $request->categoryId;
        $blog->blogTitle = $request->blogTitle;
        $blog->blogShortDescription = $request->blogShortDescription;
        $blog->blogLongDescription = $request->blogLongDescription;
        if(isset($imagePath)){
            $blog->blogImage = $imagePath;
        }
        $blog->publicationStatus = $request->publicationStatus;
        $blog->save();
        return redirect('/blog/manage-blog')->with('message','Blog info update successfully');
    }
    public function deleteBlog(Request $request){
        $blog = Blog::find($request->id);
        if(file_exists($blog->blogImage)){
            unlink($blog->blogImage);
        }
        $blog->delete();
        return redirect('/blog/manage-blog')->with('message','Blog info delete successfully');
    }
    public function manageComment(){
        $comments   = DB::table('comments')
                        ->join('visitors', 'comments.visitorId','=','visitors.id')
                        ->join('blogs','comments.blogId','=','blogs.id')
                        ->select('comments.*','visitors.firstName','visitors.lastName','blogs.blogTitle')
                        ->orderBy('comments.id','desc')
                        ->get();
        
        return view('admin.comment.manage-comment',['comments' =>$comments]);
    }
    public function unpublishedComment($id){
        $comment = Comment::find($id);
        $comment->publicationStatus = 0;
        $comment->save();
        return redirect('/manage-comment');
    }
    public function publishedComment($id){
        $comment = Comment::find($id);
        $comment->publicationStatus = 1;
        $comment->save();
        return redirect('/manage-comment');
    }
}
