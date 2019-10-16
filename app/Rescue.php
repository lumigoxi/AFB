<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use app\PetPicture;

class Rescue extends Model
{
    //
	protected $fillable = [
        'reason', 'description', 'located_at', 'idUser'
    ];

public static function RescueInfo(){
	return DB::table('rescues')
                                    ->leftjoin('users', 'users.id', '=', 'rescues.user_id')
                                    ->select('rescues.*', 'users.name')
                                    ->get();
			}

public function user(){
	return $this->belongsTo(User::class);
}

public function pets(){
    return $this->hasMany(Pet::class);
}

public static function deleteRescue($id){
    return DB::transaction(function () use ($id) {

        $pets = DB::table('pets as p')->select('p.id')->where('rescue_id', '=', $id)->get();
        foreach ($pets as $pet) {
            $pictures = DB::table('pet_pictures')->where('pet_id', '=', $pet->id)->count();
                if ($pictures > 0) {
                    $paths = DB::table('pet_pictures')->select('path')->where('pet_id', '=', $pet->id)->get();
                    foreach ($paths as $path) {
                            File::delete($path->path);
                    }
                    PetPicture::where('pet_id',$pet->id)->delete();
                }   
        }

    DB::table('rescues')->whereId($id)->delete();
    DB::table('pets')->where('rescue_id', '=' ,$id)->delete();

    });

}
}
