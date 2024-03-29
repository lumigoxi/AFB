<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Pet;
use app\Rescue;
use app\User;

class RescueController extends Controller
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
        $Response = $request->validate([
            'reason'=>'required',
            'located_at'=>'required',
            'description' => 'nullable'
        ]);
        return Rescue::create($Response) ? 1 : 0;
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
        $rescue = Rescue::findOrFail($id);
        $user = $rescue->user;
        $pets = $rescue->pets;
        return $rescue;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \app\Rescue  $rescue
     * @return \Illuminate\Http\Response
     */
    public function edit($request)
    {
        //
        $user =User::select('name', 'email', 'id')
                ->where('name', 'LIKE', "%{$request}%")
                ->orWhere('email', 'LIKE', "%{$request}%")
                ->take(1)
                ->get();    
        return $user;
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
        }else if($request['type_update'] == 'status'){
          $Response = $request->validate([
                'status' => 'required|digits_between:0,2'
            ]);  


          $pets = Pet::where('rescue_id', $id)->count();
            if ($pets > 0) {
                return 'No se puede cambiar de estado porque ya tiene mascotas asigandas';
            }else{
                return Rescue::whereId($id)->update($Response) ? 1:0;
            }

        }else if($request['type_update']== 'all'){
            $Response = $request->validate([
                'user_id' => 'required',
                'description' => 'nullable',
                'reason' => 'required',
                'located_at' => 'required'
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
    public function destroy($id)
    {
        //

        
        return Rescue::deleteRescue($id) ? 1 : 0;
    }

    public function getAll(){
        
         $rescues = Rescue::RescueInfo();
         foreach ($rescues as $rescue) {
            if ($rescue->name == null) {
                $rescue->name = '--No establecido--';
            }
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
             $rescue->pets = Pet::where('rescue_id', $rescue->id)->count();
             //$rescue->other = User::findOrFail($rescue->user_id);
         }

          
            return datatables()->of($rescues)
            ->addColumn('btn', 'rescue.actions')
            ->addIndexColumn()
            ->rawColumns(['btn'])
            ->toJson();
    }
}
