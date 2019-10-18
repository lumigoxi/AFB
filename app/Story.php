<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use app\RequestPet;

class Story extends Model
{
    //
	public function requestPet(){
		return $this->belongsTo(RequestPet::class, 'request_pets_id');
	}
}
