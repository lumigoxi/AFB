<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Activity;
use app\AllPage;
use app\Landing;
use app\Pet;
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
        $pets = Pet::getAll();
        $page = AllPage::find(1);
    	return view('front.adopt')->with(['pets'=> $pets, 'page'=>$page]);
    }

    public function activityView(){

    	$activities = Activity::orderBy('date', 'desc')->get();
    	return view('front.activity')->with('activities', $activities);
    }
}
