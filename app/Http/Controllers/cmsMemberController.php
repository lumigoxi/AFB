<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\User;

class cmsMemberController extends Controller
{

    public function __construct(){
        $this->middleware(['auth','IsActive', 'IsAdmin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Landing.member');
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
        return User::findOrFail($id);
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
        if ($request['visible'] != '' ) {
        $response = $request->validate([
            'visible' => 'required|boolean'
        ]);
        if ($response['visible'] == 0) {
            return User::whereId($id)->update(['visible'=>1]);
        }else if($response['visible']==1){
            return User::whereId($id)->update(['visible'=>0]);
        }else{
            return 0;
        }    # code...
        }else if($request['description'] != ''){
            $Response = $request->validate([
            'description' => 'required | min:20'
        ]);
        if ($Response['description']) {
        return User::whereId($id)->update($Response);
        }
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
