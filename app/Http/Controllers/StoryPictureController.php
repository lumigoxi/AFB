<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use app\PetPicture;
use app\StoryPicture;

class StoryPictureController extends Controller
{
     public function __construct(){
        $this->middleware(['IsActive', 'IsAdmin']);
    }
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
        //
        switch ($request['from']) {
            case 'gallery':
                $response = $request->validate([
                    'story_id' => 'required',
                    'idImage' => 'required'
                ]);
                $PathImage = PetPicture::find($request['idImage'])->path;
                //$basePath = substr($PathImage, 0, -15);
                //jpeg,png,jpg,gif,svg
                //storage/pictures_pet/firulais-3_1570753634.jpg
                $pattern = '[jpg|jpeng|png|gif|svg]';
                preg_match($pattern, $PathImage, $numChar, PREG_OFFSET_CAPTURE);
                $basePath = substr($PathImage, 0, ($numChar[0][1]-1));
                $extention = $numChar[0][0];
                $basePath = substr($basePath, 21, -11);
                $fileNameToStored = $basePath.'_'.time().'.'.$extention;
                $thumbnailPath = 'storage/pictures_story/'.$fileNameToStored;

                $createRegister = StoryPicture::create([
                    'story_id' => $response['story_id'],
                    'path' => $thumbnailPath
                    ]) ? 1 : 0;

                 $copyImage = File::copy($PathImage, $thumbnailPath) ? 1 : 0;

                 if ($createRegister && $copyImage) {
                     return 1;
                 }else{
                    return 'Algo no sa salido bien, no se garatiza que se haya guardado la imagen';
                 }

                break;
            case 'form':
                $this->validate($request, [
                        'path' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
                        'story_id' => 'required'
                     ]);
                $path = $request->file('path');
                $fileSize = round(($request->file('path')->getClientSize() / 1024), 2);
                $fileNameWithExtension = $path->getClientOriginalName();
                $fileNameWithoutExtension = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                $extention = $path->getClientOriginalExtension();
                $fileNameToStored = $fileNameWithoutExtension.'_'.time().'.'.$extention;
                $thumbnailPath = storage_path('app/public/pictures_story/'.$fileNameToStored);
                $img = Image::make($path)
                    ->resize(1200,720)
                    ->save($thumbnailPath) ? 1 : 0;

                    $db = StoryPicture::create(['story_id'=>$request['story_id'], 'path'=> 'storage/pictures_story/'.$fileNameToStored]) ;

                    if ($img && $db) {
                        return 1;
                    }else{
                        return 'Algo saslio mal, la imagen pudo no haberse guardado';
                    }
            break;
            default:
                # code...
                break;
        }
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
        return StoryPicture::where('story_id', $id)->get();
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
        $response = $request->validate([
            'story_id' => 'required'
        ]);
        return StoryPicture::updateDef($id, $response['story_id']) ? 1:0;
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
        $picture = PetPicture::find($id);
        $path = $picture['path'];
        $resultDB = DB::table('pet_pictures')->whereId($id)->delete() ? 1 : 0;
        $resultFile = File::delete($path) ? 1 : 0;
        return  ($resultFile == 1 && $resultDB = 1) ? 1 : 0 ;
    }
}
