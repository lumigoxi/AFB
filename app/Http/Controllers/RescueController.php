<?php

namespace app\Http\Controllers;

use app\Rescue;
use Illuminate\Http\Request;

class RescueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rescue.index');
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
     * @param  \app\Rescue  $rescue
     * @return \Illuminate\Http\Response
     */
    public function show(Rescue $rescue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \app\Rescue  $rescue
     * @return \Illuminate\Http\Response
     */
    public function edit(Rescue $rescue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \app\Rescue  $rescue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rescue $rescue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \app\Rescue  $rescue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rescue $rescue)
    {
        //
    }

    public function getAll(){
         $rescues = Rescue::RescueInfo();
            return datatables()->of($rescues)
            ->addColumn('btn', 'activity.actions')
            ->rawColumns(['btn'])
            ->toJson();
    }
}
