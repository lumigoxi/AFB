<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
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
}
