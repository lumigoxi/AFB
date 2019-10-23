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

		$stories = DB::table('stories as s')->select('s.*', 'p.name as petName', 'rp.pet_id as idPet', 									'u.name as userName','rp.name as ownerName', 											'rp.lastName as ownerLastName', 'rp.updated_at as dateAdopted')
						->leftjoin('users as u','s.user_id', '=',  'u.id')
						->leftjoin('request_pets as rp','s.request_pets_id', '=', 'rp.id')
						->leftjoin('pets as p', 'rp.pet_id', '=', 'p.id')
						->where('rp.status', '=', 1)
						->get();

			return $stories;
	}


	public static function getForFront(){
		$stories = DB::table('stories as s')->select('s.title', 's.text', 's.created_at', 											'u.name', 'sp.path', 's.id')
									->leftjoin('users as u', 'u.id', '=', 's.user_id')
									->leftjoin('story_pictures as sp', 's.id', '=', 'sp.story_id')
									->where('sp.defPic', '=', 1)
									->where('s.status', '=', 1)
									->get();

		return $stories;
	}


}
