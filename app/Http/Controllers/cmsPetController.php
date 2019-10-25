<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Pet;

class cmsPetController extends Controller
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
        return view('Landing.pet');
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
        //
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
        if ($request['type_update'] == 'visible') {
            $response =  $request->validate([
            'visible' => 'required|integer|between:0,1',
        ]);

        if ($response['visible']==0) {
            return Pet::whereId($id)->update(['visible'=>1]) ? 1 : 0;
        }else{
            return Pet::whereId($id)->update(['visible'=>0]) ? 1 : 0;
        }
        }else if($request['type_update']=='all'){
            $response = $request->validate([
                'description' => 'required'
            ]);

            return Pet::whereId($id)->update($response) ? 1 : 0;
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
