<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use app\Activity;
use app\AllPage;
use app\Landing;
use app\Pet;
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
                                            ->get();

                $pictures = StoryPicture::where('story_id', $request['story_id'])->get();
                $story->put('pictures', $pictures);
            
            return $story;
    }
}
