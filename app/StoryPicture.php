<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class StoryPicture extends Model
{
    //
	protected $fillable = [
        'story_id', 'path'
    ];


     public static function updateDef($id, $idStory){
    			$RU = StoryPicture::where('story_id', '=', $idStory)->update(['defPic' => 0]) ? 1 : 0;
    			$RS = StoryPicture::whereId($id)->update(['defPic'=> 1]) ? 1 : 0;

    			if ($RU === 1 && $RS === 1) {
    				return 1;
    			}else{
    				return 0;
    			}
    }
}
