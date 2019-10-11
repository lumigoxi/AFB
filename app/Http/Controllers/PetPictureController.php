<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use app\PetPicture;

class PetPictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
       if ($request->ajax()) {
            $this->validate($request, [
                    'path' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
                    'pet_id' => 'required'
                 ]);
            $path = $request->file('path');
            $fileSize = round(($request->file('path')->getClientSize() / 1024), 2);
            $fileNameWithExtension = $path->getClientOriginalName();
            $fileNameWithoutExtension = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extention = $path->getClientOriginalExtension();
            $fileNameToStored = $fileNameWithoutExtension.'_'.time().'.'.$extention;
            $thumbnailPath = storage_path('app/public/pictures_pet/'.$fileNameToStored);
            $img = Image::make($path)
                ->resize(1200,720)
                ->save($thumbnailPath);

                PetPicture::create(['pet_id'=>$request['pet_id'], 'path'=> 'storage/pictures_pet/'.$fileNameToStored]);

            return response()->json([
                'data' => [
                    'savedName' => $fileNameToStored,
                    'fileSize'  => $fileSize,
                    'uploaded'  => true,
                    'status'    => "Image Uploaded Successfully"
                ]
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \app\PetPicture  $petPicture
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $response = $request->validate([
            'pet_id' => 'required|integer'
        ]);
        return PetPicture::where('pet_id', '=', $response)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \app\PetPicture  $petPicture
     * @return \Illuminate\Http\Response
     */
    public function edit(PetPicture $petPicture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \app\PetPicture  $petPicture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $response = $request->validate([
            'pet_id' => 'required'
        ]);
        return PetPicture::updateDef($id, $response['pet_id']) ? 1:0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \app\PetPicture  $petPicture
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $picture = PetPicture::find($id);
        $path = $picture['path'];
        $resultDB = DB::table('pet_pictures')->whereId($id)->delete() ? 1 : 0;
        $resultFile = File::delete($path) ? 1 : 0;
        return  ($resultFile == 1 && $resultDB = 1) ? 1 : 0 ;
    }
}
