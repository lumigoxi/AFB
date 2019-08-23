<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;

class frontController extends Controller
{
    
    public function storyView(){
    	return view('front.storys');
    }

    public function adoptView(){
    	return view('front.adopt');
    }

    public function activityView(){
    	return view('front.activity');
    }
}
