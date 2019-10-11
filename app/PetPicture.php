<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class PetPicture extends Model
{
    //
	protected $fillable = [
        'pet_id', 'path'
    ];


    public static function updateDef($id, $idPet){
    			$RU = PetPicture::where('pet_id', '=', $idPet)->update(['defPicture' => 0]) ? 1 : 0;
    			$RS = PetPicture::whereId($id)->update(['defPicture'=> 1]) ? 1 : 0;

    			if ($RU === 1 && $RS === 1) {
    				return 1;
    			}else{
    				return 0;
    			}
    }
}
