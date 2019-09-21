<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Activity;
use app\Landing;

class frontController extends Controller
{
    
    public function index(){
        $calls = Landing::all();
        return view('welcome')->with('calls', $calls);
    }

    public function storyView(){
    	return view('front.storys');
    }

    public function adoptView(){
    	return view('front.adopt');
    }

    public function activityView(){

    	$activities = Activity::orderBy('date', 'desc')->get();
        dd($activities);
    	return view('front.activity')->with('activities', $activities);
    }
}
