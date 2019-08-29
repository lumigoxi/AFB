<?php

namespace app\Http\Controllers;

use app\User;
use Illuminate\Http\Request;

class memberController extends Controller
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
        
      return view('member.index');
    }

    public function getAll(){
            return datatables()->eloquent(User::query())
            ->addColumn('btn', 'member.actions')
            ->rawColumns(['btn'])
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
            'name' => 'required|max:50|min:7',
            'email' => 'required|unique:users|max:50|min:7',
            'password' => 'required|min:7'
        ]);
        
         User::create($response);

         return redirect('miembros');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \app\member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \app\member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \app\member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \app\member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(member $member)
    {
        //
    }
}
