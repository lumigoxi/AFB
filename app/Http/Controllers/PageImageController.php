<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use app\PageImage;

class PageImageController extends Controller
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
        if ($request->ajax()) {
            $this->validate($request, [
                    'path' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
                    'page_id' => 'required'
                 ]);
            $path = $request->file('path');
            $fileSize = round(($request->file('path')->getClientSize() / 1024), 2);
            $fileNameWithExtension = $path->getClientOriginalName();
            $fileNameWithoutExtension = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extention = $path->getClientOriginalExtension();
            $fileNameToStored = $fileNameWithoutExtension.'_'.time().'.'.$extention;
            $thumbnailPath = storage_path('app/public/pictures_page/'.$fileNameToStored);
            $img = Image::make($path)
                ->resize(1200,720)
                ->save($thumbnailPath);

                $db = PageImage::create(['page_id'=>$request['page_id'], 'path'=> 'storage/pictures_page/'.$fileNameToStored]);

                    if ($img && $db) {
                        return 1;
                    }
                    return 'Algo ha salido mal, no se garantiza que se haya guardado la imagen';
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
        return PageImage::select('id', 'path')->where('page_id', $id)->get();
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
        $picture = PageImage::find($id);
        $path = $picture['path'];
        $resultDB = DB::table('page_images')->whereId($id)->delete() ? 1 : 0;
        $resultFile = File::delete($path) ? 1 : 0;
        return  ($resultFile == 1 && $resultDB = 1) ? 1 : 0 ;
    }
}
