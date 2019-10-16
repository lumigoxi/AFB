<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use app\Pet;
use app\PetPicture;
use app\Rescue;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pet.index');
    }



    public function getAll(Request $request){
        if ($request->request_url == "cms") {
            $pets = Pet::getOnlyAvaible();
        foreach ($pets as $pet) {

            if ($pet->visible == 0) {
                $pet->visible = 'No publicado';
            }else{
                $pet->visible = 'Publicado';
            }

            if ($pet->located_at == null) {
                $pet->located_at = '--No definido--';
            }else{
                if ($pet->city != '') {

                    $pet->located_at .=  ' | '.$pet->city;
                }else{
                    $pet->located_at;
                }
            }


            if ($pet->breed == null) {
                $pet->breed = '--Sin definir--';
            }
        }
        return  datatables()->of($pets)
            ->addColumn('btn', 'pet.actions-cms')
            ->addIndexColumn()
            ->rawColumns(['btn'])
            ->toJson();





        }else if($request->request_url == "tps"){
            $pets = Pet::all();
        foreach ($pets as $pet) {


            if ($pet->status == 0) {
                $pet->status = 'Sin definir';
            }else if($pet->status == 1){
                $pet->status = 'En tratamiento';
            }else if($pet->status){
                $pet->status = 'Recuperado';
            }

            if ($pet->breed == null) {
                $pet->breed = '--Sin definir--';
            }

            if ($pet->located_at == null) {
                $pet->located_at = '--No definido--';
            }else{
                if ($pet->city != '') {

                    $pet->located_at .=  ' | '.$pet->city;
                }else{
                    $pet->located_at;
                }
            }


            if ($pet->avaible == 0) {
                $pet->avaible = 'disponible';
            }else{
                $pet->avaible = '--no disponible--';
            }

        }

        
        return  datatables()->of($pets)
            ->addColumn('btn', 'pet.actions')
            ->addIndexColumn()
             ->addColumn('statusOption', 'pet.status')
            ->rawColumns(['btn', 'statusOption'])
            ->toJson();
        }
        
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
        if ($request['store_origin'] == 'rescue') {

            $request->request->add(['id' => $request['rescue_id']]);
            $Response = $request->validate([
                'name' => 'required',
                'breed' => 'nullable',
                'id' => 'required|exists:rescues', 
                'rescue_id' => 'required'
            ]);
                $rescue = Rescue::find($Response['rescue_id']);
                if ($rescue->status == 0 ) {
                     return Pet::create($Response) ? 1 : 0;
                }else{
                    return 'Debe completar el rescate antes de agregar las mascotas';
                }
           
        }

        if ($request['store_origin'] == 'tasks') {
            $request->request->add(['id' => $request['rescue_id']]);
            $Response = $request->validate([
                'name' => 'required',
                'breed' => 'nullable',
                'id' => 'required|exists:rescues', 
                'rescue_id' => 'required'
            ]);
            $rescue = Rescue::find($Response['rescue_id']);
            if ($rescue->status == 0) {
                return Pet::create($Response) ? 1 : 0;    
            }else{
                return 'No se puede guardar los datos porque el rescate no se ha completado';
            }
            
        }

        // $Response = $request->validate([
        //     'name' => 'required',
        //     'located_at' => 'required',
        //     'rescue_id' => 'required'
        // ]);

        // return Pet::create($Response) ? 1 : 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  \app\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $pet = Pet::findOrfail($id);
        $pet->rescue;
        return $pet;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \app\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit($request)
    {
        //
        $rescues =  Rescue::
                leftjoin('users', 'users.id', '=', 'rescues.user_id')
                ->select('rescues.reason', 'rescues.user_id', 'rescues.id', 'rescues.located_at','users.name', 'rescues.created_at')
                ->where('users.name', 'LIKE', "%{$request}%")
                ->orWhere('users.email', 'LIKE', "%{$request}%")
                ->orWhere('rescues.located_at', 'LIKE', "%{$request}%")
                ->get();   
                Carbon::setLocale('es'); 
                foreach ($rescues as $rescue) {
                    $rescue->date = Carbon::parse($rescue->created_at)->formatLocalized('%d %B %Y');
                 } 
        return $rescues;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \app\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if ($request['type_update'] == 'all') {
            $Response = $request->validate([
            'name' => 'required',
            'breed' => 'nullable',
            'city' => 'nullable',
            'located_at' => 'nullable'
        ]);
                $pet = Pet::find($id);

                if ($pet->avaible == 0) {
                    return Pet::whereId($id)->update($Response) ? 1:0;
                }else{
                    return 'No se puede actualizar porque esta mascota ya ha sido adoptada';
                }
        }else if($request['type_update'] == 'status'){
            $respose = $request->validate([
                'status' => 'required'
            ]);
            $pet = Pet::find($id);

            if ($pet->avaible == 0) {
                return Pet::whereId($id)->update($respose) ? 1 : 0;
            }else{
                return 'No se puede actualizar el estado porque ya ha sido aopdatado';
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \app\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $pet = Pet::find($id);
            if ($pet->avaible == 'disponible') {
                $pictures = DB::table('pet_pictures')->where('pet_id', '=', $id)->count();
                if ($pictures > 0) {
                    $paths = DB::table('pet_pictures')->select('path')->where('pet_id', '=', $id)->get();
                    foreach ($paths as $path) {
                            File::delete($path->path);
                    }
                    PetPicture::where('pet_id', $id)->delete();
                }
                return Pet::whereId($id)->delete() ? 1 : 0;
            }else{
                return 'No se puede eliminar esta mascota porque ya fue adoptada';
            }
    }

    
}
