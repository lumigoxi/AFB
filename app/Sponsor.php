<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    //
	public function Activities(){
		return $this->belongsToMany(Activity::class, SponsorActivity::class);
	}
}
