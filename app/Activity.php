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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
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
}
