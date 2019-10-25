<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use app\User;

class memberController extends Controller
{

   public function __construct(){
        $this->middleware('IsActive');
        $this->middleware('SuperAdmin');
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

                if ($member->role == 1) {
                    $member->role="Admin";
                }else if($member->role == 2){
                    $member->role = "Super Admin";
                }else{
                     $member->role="Miembro";
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

        if ($request['origin'] == 'role') {
            $user = User::find($id);
            if ($user['role'] == 2) {
                return 'No puedes cacmbiar de rol';
            }

            $Response = $request->validate([
                'role' => 'required|digits_between:0,1'
            ]);
                return User::whereId($id)->update($Response) ? 1 : 0; 
            
        }
        if ($request['request_url']=='tps') {

            $user = User::find($id);
                if (User::find($id)['role'] == 2) {
                    return 'No se puede inactivar porque es super administrador';
                }

            $Response = $request->validate([
                'status' => 'required|digits_between:0,1'
            ]);
                return User::whereId($id)->update($Response) ? 1 : 0;            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \app\member  $member
     * @return \Illuminate\Http\Response
     */
   

   public function destroy($id)
    {
        if (User::find($id)['role'] == 2) {
            return 'No se puede eliminar porque es Super Administrador';
        }
        return User::findOrFail($id)->delete() ? 1 : 0;
    }
}
