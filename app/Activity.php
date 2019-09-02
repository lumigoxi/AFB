<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Activity extends Model
{
    //

	public function user(){
		return $this->belongsTo(User::class, 'idUser');
	}

	public static function ActivityUser(){
        return DB::table('activities')
                                    ->join('users', 'users.id', '=', 'activities.idUser')
                                    ->select('activities.*', 'users.name')
                                    ->get();
    }
}
