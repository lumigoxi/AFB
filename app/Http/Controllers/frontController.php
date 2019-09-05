<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Activity;

class frontController extends Controller
{
    
    public function storyView(){
    	return view('front.storys');
    }

    public function adoptView(){
    	return view('front.adopt');
    }

    public function activityView(){

    	$activities = Activity::orderBy('date', 'desc')->get();
    	return view('front.activity')->with('activities', $activities);
    }
}
