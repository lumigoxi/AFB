<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use app\Story;
use app\StoryPicture;

class StoryController extends Controller
{
    
     public function __construct(){
        $this->middleware(['IsActive', 'IsAdmin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('story.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $response = $request->validate([
            'request_pets_id' => 'required',
            'title' => 'required|string',
            'text' => 'required|string'
        ]);
        $allData = array_merge($response, ['user_id'=>Auth::user()->id]);
        return Story::create($allData) ? 1 : 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $story = Story::find($id);
        $story->user;
        $requestPet = $story->requestPet;
        $requestPet->pet;
        return $story;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        switch ($request['type_update']) {
            case 'status':
                $response = $request->validate([
                    'status' => 'required|numeric|between:0,1',
                ]);

                    return Story::whereId($id)->update($response) ? 1 : 0;
                break;
            

            case 'all':
                if ($request->request_pets_id == null) {
                    $response = $request->validate([
                        'title' => 'required',
                        'text' => 'required',
                    ]);

                    return Story::find($id)->update($response) ? 1 : 0;
                }else{
                    $response = $request->validate([
                        'title' => 'required',
                        'text' => 'required',
                        'request_pets_id' => 'required'
                    ]);
                    return Story::find($id)->update($response) ? 1 : 0;
                }
            break;
            default:
                # code...
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
       // return Story::findOrFail($id)->delete() ? 1 : 0;

        $pet = Story::find($id);
                $pictures = DB::table('story_pictures')->where('story_id', '=', $id)->count();
                if ($pictures > 0) {
                    $paths = DB::table('story_pictures')->select('path')->where('story_id', '=', $id)->get();
                    foreach ($paths as $path) {
                            File::delete($path->path);
                    }
                    StoryPicture::where('story_id', $id)->delete();
                }
                return Story::whereId($id)->delete() ? 1 : 0;
            
    }

    public function getAll(){
        $stories = Story::getAllStories();

            foreach ($stories as $story) {
                $story->status == 0 ? ($story->status = '--sin publicar--') : ($story->status = 'publicado');
            }
         return  datatables()->of($stories)
             ->addColumn('btn', 'story.actions')
             ->addIndexColumn()
            //  ->addColumn('statusOption', 'pet.status')
             ->rawColumns(['btn', 'statusOption'])
            ->toJson();
    }
}
