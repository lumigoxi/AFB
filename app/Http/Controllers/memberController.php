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

             $members = User::all();
            foreach ($members as $member) {
                if ($member->visible == 1) {
                    $member->visible = 'Listado';
                }else{
                    $member->visible = 'No Listado';
                }
            }
            return datatables()->of($members)
            ->addColumn('btn', 'member.actions')
            ->rawColumns(['btn'])
            ->toJson();
        }else if ($request->request_url == "tps") {
            $members = User::all();

            foreach ($members as $member) {
                if ($member->status == 1) {
                    $member->status = 'Activo';
                }else{
                    $member->status = 'Inactivo';
                }
            }
            return datatables()->of($members)
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
       $passwordEquals =  $request['password'] === $request['password_confirmation'];
        if ($passwordEquals) {
             $response = $request->validate([
            'name' => 'required|max:50|min:7',
            'email' => 'required|unique:users|max:50|min:7',
            'password' => 'required|min:7'
             ]);
        $response['password'] = bcrypt($response['password']);
         return User::create($response) ? 1 : 0;
        }else{
            return 'Las contraseñas no coinciden';
        }
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
    public function update(Request $request, $id)
    {
        if ($request['request_url']=='tps') {
            $Response = $request->validate([
                'status' => 'required|digits_between:0,1'
            ]);
            if ($Response['status'] == 0) {
                return User::whereId($id)->update(['status' => 1] ) ? 1 : 0;
            }else{
                return User::whereId($id)->update(['status' => 0]) ? 1 : 0;
            }
        }
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
