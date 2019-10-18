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
        $member = AllPage::find(3); 
        return view('welcome',[
            'calls' => $calls,
            'users' => $users,
            'member' => $member
        ]);
    }

    public function storyView(){
    	return view('front.storys');
    }

    public function adoptView(){
        $page = AllPage::find(1);
    	return view('front.adopt')->with(['page'=>$page]);
    }

    public function activityView(){
        $page = AllPage::find(2);
    	$activities = Activity::getForFront();
        foreach ($activities as $activity) {
            $activity->date = date("d-m-Y h:i", strtotime($activity->date));
        }
    	return view('front.activity')->with(['activities'=> $activities,
                                                'page' => $page]);
    }


    public function getAllPets(){
         return Pet::getForFront();
    }
    public function contactView(){
        return view('front.contact');
    }
}
