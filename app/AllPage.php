<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class AllPage extends Model
{
    //
	
	public function images(){
		return $this->hasMany(PageImage::class, 'page_id');
	}
}
