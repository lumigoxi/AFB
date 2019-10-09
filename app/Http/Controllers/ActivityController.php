<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Activity;
use app\ActivityPicture;



class ActivityController extends Controller
{


    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('activity.index');
    }


    public function getAll(){

        $activities = Activity::ActivityUser();

        
        foreach ($activities as $activity) {
             $activity->date =  date("d-m-Y h:i", strtotime($activity->date));
             if ($activity->status == 0) {
                 $activity->status = 'Sin Publicar';
             }else{
                $activity->status = 'Publicado';
             }
        }
            return datatables()->of($activities)
            ->addColumn('btn', 'activity.actions')
            ->addColumn('status', 'activity.status')
            ->rawColumns(['btn', 'status'])
            ->toJson();

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
            'activity' => 'required',
            'decription' => 'required',
            'date' => 'required'
        ]);
        
         $id = array("idUser"=>Auth::id());
         $newA = array_merge($response, $id);
        
         return Activity::create($newA) ? 1 : 0;
           
          }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->date = date("Y-m-d\Th:i", strtotime($activity->date));
        return $activity;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if($request['type_update'] === 'app-picture'){
            return 'asdnkasn';
        }
        if ($request['type_update'] === 'all') {
            $Response = $request->validate([
            'activity' => 'required',
            'decription' => 'required',
            'date' => 'required|date|after:today'
        ]);

        return Activity::whereId($id)->update($Response) ? 1:0;
        }else if($request['type_update'] === 'status'){
            $response = $request->validate([
                'status' => 'required|integer|between:0,1'
            ]);

            return Activity::whereId($id)->update($response) ? 1:0;
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
        return Activity::deleteActivity($id) ? 1 : 0;
    }
}
