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
    public function show($id)
    {
        //
        return Rescue::findOrFail($id);
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
    public function update(Request $request, $id)
    {
        //
        if ($request['type_update'] == 'priority') {
            $Response = $request->validate([
                'priority' => 'required|digits_between:0,2'
            ]);

            return Rescue::whereId($id)->update($Response) ? 1 : 0;
        }
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
         foreach ($rescues as $rescue) {
             if ($rescue->priority == 0) {
                 $rescue->priority = 'Alta';
             }else if($rescue->priority == 1){
                $rescue->priority = 'Media';
             }else{
                $rescue->priority = 'Baja';
             }
             if ($rescue->status == 0) {
                $rescue->status = 'Listo';
             }else if ($rescue->status == 1 ) {
                 $rescue->status = 'En curso';
             }else{
                $rescue->status = 'Pendiente';
             }
         }
            return datatables()->of($rescues)
            ->addColumn('btn', 'rescue.actions')
            ->addIndexColumn()
            ->rawColumns(['btn'])
            ->toJson();
    }
}
