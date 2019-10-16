<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use app\Pet;
use app\Rescue;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('task.index');
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
        $rescue = Rescue::find($id);
        $pets = $rescue->pets;
        return $rescue;
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
        if ($request['type_update'] == 'status') {
            $response = $request->validate([
            'status' => 'required|numeric|between:0,2'
        ]);
            $pets = Pet::where('rescue_id', $id)->count();
            if ($pets > 0) {
                return 'No se puede cambiar de estado porque ya tiene mascotas asigandas';
            }else{
                return Rescue::whereId($id)->update($response) ? 1:0;
            }


        }else if($request['type_update'] == 'note'){
            $response = $request->validate([
            'note' => 'required|max:255'
        ]);

        return Rescue::whereId($id)->update($response) ? 1:0;
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

    public function getMyTasks(){
        $user = Auth::user()->id;
        $rescues = DB::table('rescues as r')->select('r.*')->where('user_id', '=', $user)->get();
        foreach ($rescues as $rescue) {
             if ($rescue->priority == 0) {
                 $rescue->priority = 'Alta';
             }else if($rescue->priority == 1){
                $rescue->priority = 'Media';
             }else if($rescue->priority == 2){
                $rescue->priority = 'Baja';
             }else{
                $rescue->priority = 'Sin Prioridad';
             }
             if ($rescue->status == 0) {
                $rescue->status = 'Listo';
             }else if ($rescue->status == 1 ) {
                 $rescue->status = 'En curso';
             }else if($rescue->status == 2){
                $rescue->status = 'Pendiente';
             }else{
                $rescue->status = 'Sin Estado';
             }
         }
        return datatables()->of($rescues)
            ->addIndexColumn()
            ->addColumn('btn', 'task.actions')
            ->addColumn('btn-status', 'task.status')
            ->rawColumns(['btn', 'btn-status'])
            ->toJson();;
    }
}
