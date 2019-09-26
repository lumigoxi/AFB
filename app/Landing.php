<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Landing extends Model
{
    //
	 protected $fillable = [
        'call_to_action',
        'mission',
        'vision'
    ];


    public static function getMisionVision(){
    	return DB::table('landings')->select('mission', 'vision')->get();
    }
    
}
