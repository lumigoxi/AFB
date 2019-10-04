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
                                    ->leftjoin('users', 'users.id', '=', 'rescues.user_id')
                                    ->select('rescues.*', 'users.name')
                                    ->get();
			}

public function user(){
	return $this->belongsTo(User::class);
}

public function pets(){
    return $this->hasMany(Pet::class);
}

public static function deleteRescue($id){
    return DB::transaction(function () use ($id) {
    DB::table('rescues')->whereId($id)->delete();
    DB::table('pets')->where('rescue_id', '=' ,$id)->delete();
    });

}
}
