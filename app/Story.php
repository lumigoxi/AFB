<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use app\RequestPet;

class Story extends Model
{
    //

	protected $fillable = ['title', 'text', 'user_id', 'request_pets_id'];


	public function requestPet(){
		return $this->belongsTo(RequestPet::class, 'request_pets_id');
	}

	public function user(){
		return $this->belongsTo(User::class);
	}
	public static function getAllStories(){

		$stories = DB::table('stories as s')->select('s.*', 'p.name as petName', 'u.name as userName', 
						 'rp.name as ownerName', 'rp.lastName as ownerLastName', 'rp.updated_at as dateAdopted')
						->leftjoin('users as u','s.user_id', '=',  'u.id')
						->leftjoin('request_pets as rp','s.request_pets_id', '=', 'rp.id')
						->leftjoin('pets as p', 'rp.pet_id', '=', 'p.id')
						->get();

			return $stories;
	}
}
