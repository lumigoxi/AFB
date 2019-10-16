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


    public static function getForFront(){
        return DB::table('pets as p')->select('p.name', 'p.description',  'p.breed', 'p.located_at', 'p.city', 'pi.path', 'p.id')
                                    ->leftjoin('pet_pictures as pi','p.id', '=', 'pi.pet_id')
                                    ->where('pi.defPicture', '=', 1) //verefiva si tiene una foto asignada
                                    ->where('p.visible', '=', 1)// verifica si esta publicado
                                    ->where('p.status', '=', 2) // verifica si ya esta recuperado
                                    ->where('p.avaible', '=', 0) // verifica si esta disponible
                                    ->get();
    }
}
