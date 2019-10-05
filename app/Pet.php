<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use app\Rescue;

class Pet extends Model
{
    //
	protected $fillable = [
        'name', 'located_at', 'rescue_id', 'breed'
    ];


    public function rescue(){
    		return $this->belongsTo(Rescue::class);
    }

    public function pictures(){
    		return $this->hasMany(PetPicture::class);
    }

    public static function getAll(){
        return DB::table('pets')
                    ->where('pets.visible', '=', '1')
                    ->where('pets.status', '=', '2')
                    ->where('pets.avaible', '=', '0')
                    ->leftjoin('pet_pictures', 'pet_pictures.pet_id', '=', 'pets.id')
                    ->select('pets.name', 'pets.city', 'pets.breed', 'pets.description', 'pet_pictures.*')
                    ->get();
    }

    public static function getOnlyAvaible(){
        return DB::table('pets')
                    ->where('pets.avaible', '=', '0')
                    ->where('pets.status', '=', '2')
                    ->select('pets.*')
                    ->get();
    }
}
