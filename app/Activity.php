<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Activity extends Model
{
    //

 protected $fillable = [
        'activity', 'decription', 'date', 'idUser',
    ];

    
	public function user(){
		return $this->belongsTo(User::class, 'idUser');
	}

	public static function ActivityUser(){
        
        return DB::table('activities')
                                    ->join('users', 'users.id', '=', 'activities.idUser')
                                    ->select('activities.*', 'users.name')
                                    ->orderBy('activities.date', 'desc')
                                    ->get();
    }

    public function sponsors(){
        return $this->belongsToMany(Sponsor::class, SponsorActivity::class);
    }
}
