<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use app\Pet;
use app\RequestPet;

class RequestPetController extends Controller
{


     private static function changeStatus($idRequestPet, $idpet, $status, $response){
        try {
                DB::beginTransaction();
                DB::table('request_pets')->whereId($idRequestPet)->update($response);
                DB::table('pets')->whereId($idpet)->update(['avaible' => $status]);
                DB::commit();
                return 1;
            } catch (Exception $e) {
                DB::rollback();
                return 0;
            } 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('requestPet.index');
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
     * @param  \app\RequestPet  $requestPet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $requets = RequestPet::find($id);
        $requets->pet;
        return $requets;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \app\RequestPet  $requestPet
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestPet $requestPet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \app\RequestPet  $requestPet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        switch ($request['type_update']) {
             case 'seen':

                if (RequestPet::find($id)->status != 0) {
                    return 'No se puede actualizar porque ya se ha aprobado la solicitud';
                }
                 $response = $request->validate([
                    'seen' => 'required|between:0,1'
                 ]);
                 return RequestPet::whereId($id)->update($response) ? 1 : 0;
                 break;

                 case 'status':

                    if (RequestPet::find($id)->seen == 0) {
                        return 'No se puede aprobar la solicitud porque no se ha leido';
                    }

                 $response = $request->validate([
                    'status' => 'required|between:0,1',
                    'pet_id' => 'required'
                 ]);
                 if ($response['status'] == 0) {
                    return RequestPetController::changeStatus($id, $response['pet_id'], 0, $response) ? 1:0;
                 }else{            
                    $pet = Pet::find($response['pet_id']);
                        if ($pet->avaible == 1 ) {
                            return 'Hay otra solicitud sobre esta mascota que ya fue aprovada';
                        }elseif($pet->status != 2){
                            return 'Esta mascota no se ha recuperado aún, porfavor verificar su estado en el apartado de mascotas';
                        }else{
                            return RequestPetController::changeStatus($id, $response['pet_id'], 1, $response)?1:0; 
                            }  
                } 
                 break;
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \app\RequestPet  $requestPet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $requestPet = RequestPet::find($id);

        if ($requestPet->status == 1) {
            return 0;
        }else{
            return RequestPet::find($id)->delete() ? 1 : 0;
        }
    }

    public function getAll(){

         $requests = RequestPet::getAll();
        foreach ($requests as $request) { 
            $request->infoPet = $request->petName.' => '.$request->breed;
            $request->fullName = $request->name.' '.$request->lastName;
            if ($request->seen == 0) {
                $request->seen = 'sin revisar';
            }else{
                 $request->seen = 'revisado';
            }

            if ($request->status == 0) {
                $request->status = '--no aprobado--';
            }else{
                $request->status = 'aprobado';
            }
        }
        
        return datatables()->of($requests)
            ->addColumn('btn', 'requestPet.actions')
            ->rawColumns(['btn'])
            ->toJson();
    }


    public function getOnlyAdopted(Request $request){
        $term = $request->term;
        $owners = DB::table('request_pets as rp')->select('rp.name', 'rp.lastName', 'rp.id', 'rp.pet_id')
                    ->Where('rp.name', 'like', '%'.$term.'%')
                    ->where('rp.status', '=', 1)
                    ->get();
        $valid_pets = [];
        foreach ($owners as $owner) {
            $pet = Pet::find($owner->pet_id);
        $text = 'Nombre: '.$owner->name.' '.$owner->lastName.'  |  Mascota: '.$pet->name.'('.$pet->breed.')';
            $valid_pets[] = ['id' => $owner->id, 'text' => $text];
        }
        return \Response::json($valid_pets);
  
        }
}

