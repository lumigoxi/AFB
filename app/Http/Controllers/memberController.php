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

    public function getAll(Request $request){

        if($request->request_url == "cms"){
            return datatables()->eloquent(User::query())
            ->addColumn('btn', 'member.actions')
            ->rawColumns(['btn'])
            ->toJson();
        }else if ($request->request_url == "tps") {
            return datatables()->eloquent(User::query())
            ->addColumn('btn', 'member.actions-full')
            ->rawColumns(['btn'])
            ->toJson();
        }
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
        $response['password'] = bcrypt($response['password']);
         User::create($response);

         return redirect('miembros');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \app\member  $member
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
     * @param  \app\member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(User $member)
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
    public function destroy(Request $request, $id)
    {
        //

        
        
        

        return;
    }

    public function deleteMember(Request $request, $id){
        if ($request->ajax()) {
            $user = User::find($id);
        $user->delete();
        return; 
        }
    }
}
