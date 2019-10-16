<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use app\Pet;
use app\RequestPet;

class RequestPetController extends Controller
{
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
                 $response = $request->validate([
                    'seen' => 'required|between:0,1'
                 ]);
                 return RequestPet::whereId($id)->update($response) ? 1 : 0;
                 break;

                 case 'status':
                 $response = $request->validate([
                    'status' => 'required|between:0,1',
                    'pet_id' => 'required'
                 ]);
                 if ($response['status'] == 1) {
                     $status = RequestPet::where('pet_id', $response['pet_id'])
                                            ->where('status', $response['status'])
                                                        ->count();
                        $pet = Pet::find($response['pet_id']);
                            //vereififcar si hay otra solicitud aprobada, si la mascota ya fue adoptada, si el estado no es recuperado
                            if ($status > 0  || $pet->avaible == 1 ) {
                                return 'Hay otra solicitud sobre esta mascota que ya fue aprovada';
                            }elseif($pet->status != 2){
                                    return 'Esta mascota no se ha recuperado aún, porfavor verificar su estado en el apartado de mascotas';
                                }else{
                               try {
                                    DB::beginTransaction();
                                        DB::table('request_pets')->whereId($id)->update($response);
                                        DB::table('pets')->whereId($response['pet_id'])->update(['avaible' => 1]);
                                    DB::commit();
                                    return 1;
                                } catch (Exception $e) {
                                    DB::rollback();
                                    return 0;
                                } 
                            }
                 }else{
                                         
                            try {
                                DB::beginTransaction();
                                DB::table('request_pets')->whereId($id)->update($response);
                                DB::table('pets')->whereId($response['pet_id'])->update(['avaible' => 0]);
                                DB::commit();
                                return 1;
                            } catch (Exception $e) {
                                DB::rollback();
                                return 0;
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
}
