<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RequestPet extends Model
{
    		protected $fillable = ['name', 'lastName', 'telephone', 'email', 'message', 'contactTel', 'contactEmail', 'pet_id'];

    		public function pet(){
    			return $this->belongsTo(Pet::class);
    		}
//		
    		public static function getAll(){

    			return DB::table('request_pets as rp')->select('rp.*', 'p.name as petName', 'p.breed')
    										   ->leftjoin('pets as p', 'p.id', '=', 'rp.pet_id')
    										   ->get();

    		}
}
