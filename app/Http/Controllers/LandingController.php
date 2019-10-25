<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Landing;

class LandingController extends Controller
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
        return view('Landing.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
         $response = $request->validate([
            'call_to_action' => 'required'
            ]);
    
         Landing::create($response);
         return redirect('dashboard/landing');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Landing::find($id);
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
        if ($request['call_to_action']){
          $response = $request->validate([
             'call_to_action' => 'required'
         ]);

         Landing::whereId($id)->update($response);
         return 'ok';
        }else if($request['mission'] || $request['vision']){
            $response = $request->validate([
                'mission' => 'required | min:25',
                'vision' => 'required | min:25'
            ]);

            Landing::whereId($id)->update($response);
            return 'ok';
        }else{
            return 'error';
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
    }

   
}


// if($request['call_to_action']){
//              $response = $request->validate([
//             'call_to_action' => 'required'
//         ]);

//         $landing = Landing::whereId($id)->update($response);
//        }else if($request['mission'] && $request['vision']){
//             dd('Respuesta cd')
//        }