<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function newComment(Request $request){
        $comment = new Comment();
        $comment->visitorId  = $request->visitorId;
        $comment->blogId  = $request->blogId;
        $comment->comment  = $request->comment;
        $comment->save();
        
        return redirect('/blog/blog-details/'.$request->blogId)->with('message','your comment post successfully');
    }
}
