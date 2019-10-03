<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rescue extends Model
{
    //
	protected $fillable = [
        'reason', 'description', 'located_at', 'idUser'
    ];

public static function RescueInfo(){
	return DB::table('rescues')
                                    ->join('users', 'users.id', '=', 'rescues.idUser')
                                    ->select('rescues.*', 'users.name')
                                    ->get();
			}

public function user(){
	return $this->belongsTo(User::class);
}
}
