<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
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
            //store the original image as it is
            $request->file('path')->storeAs('public/images', $fileNameToStored);
            //resize the images
            $thumb_size = 200;
            $thumbnailPath = storage_path('app/public/pictures_pet/'.$fileNameToStored);
            $img = Image::make($path)
                ->resize($thumb_size,$thumb_size)
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
    public function show(PetPicture $petPicture)
    {
        //
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
    public function update(Request $request, PetPicture $petPicture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \app\PetPicture  $petPicture
     * @return \Illuminate\Http\Response
     */
    public function destroy(PetPicture $petPicture)
    {
        //
    }
}
