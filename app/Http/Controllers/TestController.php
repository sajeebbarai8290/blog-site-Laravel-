<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        return view('home1');
    }
    public function about(){
        return view('about');
    }
    public function service(){
        return view('service');
    }
    public function contact(){
        return view('contact');
    }
}
