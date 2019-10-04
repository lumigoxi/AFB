<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use app\Pet;
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
                'breed' => 'required|nullable',
                'id' => 'required|exists:rescues', 
                'rescue_id' => 'required'
            ]);

            return Pet::create($Response) ? 1 : 0;
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
        $Response = $request->validate([
            'name' => 'required',
            'breed' => 'required|nullable',
            'city' => 'required|nullable',
            'located_at' => 'required|nullable'
        ]);
        return Pet::whereId($id)->update($Response) ? 1:0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \app\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        //
    }

    public function getAll(){

        $pets = Pet::all();
        foreach ($pets as $pet) {
            if ($pet->status == 0) {
                $pet->status = 'Adoptado';
            }else{
                $pet->status= 'Disponible';
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
        }
        return  datatables()->of($pets)
            ->addColumn('btn', 'pet.actions')
            ->addIndexColumn()
            ->rawColumns(['btn'])
            ->toJson();
    }
}
