<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Activity;
use app\Landing;
use app\User;

class frontController extends Controller
{
    
    public function index(){
        $calls = Landing::all();
        $users = User::where('visible', 1)->get();
        return view('welcome',[
            'calls' => $calls,
            'users' => $users
        ]);
    }

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
