<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ActivityPicture extends Model
{
    //
	protected $fillable = [
        'activity_id', 'path'
    ];

    public static function updateDef($id, $idActivity){
    			$RU = ActivityPicture::where('activity_id', '=', $idActivity)->update(['defPicture' => 0]) ? 1 : 0;
    			$RS = ActivityPicture::whereId($id)->update(['defPicture'=> 1]) ? 1 : 0;

    			if ($RU === 1 && $RS === 1) {
    				return 1;
    			}else{
    				return 0;
    			}
    }
}
