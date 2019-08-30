<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Category;
use App\Visitor;
class SignUpController extends Controller
{
    public function index(){
        $categories = Category::where('publicationStatus',1)->get();
        return view('front.user.sign-up',[
            'categories' => $categories
        ]);
    }
    
    public function newSignUp(Request $request){
        Visitor::saveVisitorInfo($request);
        return redirect('/');
    }
    public function visitorLogout(Request $request){
        Session::forget('visitorId');
        Session::forget('visitorName');
        
        return redirect('/');
    }
    public function visitorLogin(){
        $categories = Category::where('publicationStatus',1)->get();
        return view('front.user.sign-in',[
            'categories' => $categories
        ]);
    }
    public function visitorSignIn(Request $request){
        $visitor = Visitor::where('emailAddress',$request->emailAddress)->first();
        if($visitor){
            if (password_verify($request->password, $visitor->password)) {
                Session::put('visitorId',$visitor->id);
                Session::put('visitorName',$visitor->firstName.' '.$visitor->lastName );
                return redirect('/');
            } else {
                return redirect('/visitor-login')->with('message','password is invalied');
            }
        }else{
            return redirect('/visitor-login')->with('message','email address is invalied');
        }
    }
    public function emailCheck($email){
        $visitor = Visitor::where('emailAddress',$email)->first();
        if($visitor){
            echo 'Email address exit';
        }else{
            echo 'Email address available';
        }
    }
}
