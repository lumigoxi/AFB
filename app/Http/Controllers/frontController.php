<?php

namespace app\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use app\Activity;
use app\ActivityPicture;
use app\AllPage;
use app\Landing;
use app\Pet;
use app\PetPicture;
use app\Story;
use app\StoryPicture;
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
        $page = AllPage::find(4);
    	return view('front.storys')->with('page', $page);
    }

    public function adoptView(){
        $page = AllPage::find(1);
    	return view('front.adopt')->with(['page'=>$page]);
    }

    public function activityView(){
        $page = AllPage::find(2);
    	return view('front.activity')->with(['page' => $page]);
    }


    public function getAllPets(){
         return Pet::getForFront();
    }
    public function contactView(){
        return view('front.contact');
    }

    public function getAllStory(){
        $stories = Story::getForFront();
        return $stories;
    }

    public function getOneStory(Request $request){
        $request->validate([
            'story_id' => 'integer'
        ]);
        $story = DB::table('stories as s')->select('s.title', 's.text', 's.created_at')
                                            ->where('s.id', '=', $request['story_id'])
                                            ->where('s.status', '=', 1)
                                            ->get();

                $pictures = StoryPicture::select('path')->where('story_id', $request['story_id'])->get();
                $story->put('pictures', $pictures);
            
            return $story;
    }


    public function getOnePet(Request $request){
        $request->validate([
            'pet_id' => 'integer'
        ]);
        $pet = DB::table('pets as p')->select('p.name', 'p.description', 'p.breed')
                                            ->where('p.id', '=', $request['pet_id'])
                                            ->where('p.status', '=', 2)
                                            ->where('p.visible', '=', 1)
                                            ->where('p.avaible', '=', 0)
                                            ->get();

                $pictures = PetPicture::select('path')->where('pet_id', $request['pet_id'])->get();
                $pet->put('pictures', $pictures);
            
            return $pet;
    }


    public function getAllActivities(){
        return Activity::getForFront();
    }

    public function getOneActivity(Request $request){
         $request->validate([
            'activity_id' => 'integer'
        ]);
        $activity = DB::table('activities as a')->select('a.activity', 'a.decription')
                                            ->where('a.id', '=', $request['activity_id'])
                                            ->where('a.status', '=', 1)
                                            ->where('a.date', '>=', Carbon::now())
                                            ->get();

                $pictures = ActivityPicture::select('path')->where('activity_id', $request['activity_id'])->get();
                $activity->put('pictures', $pictures);
            
            return $activity;
    }
}
