<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class PetPicture extends Model
{
    //
	protected $fillable = [
        'pet_id', 'path'
    ];
}
