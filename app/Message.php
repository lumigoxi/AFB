<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    //
	protected $fillable = ['name', 'lastName', 'telephone', 'email', 'reason', 'message', 'contactTel', 'contactEmail'];

	public static function  getAllMessages(){
		return DB::table('messages as m')->select('m.name', 'm.lastName', 'm.reason', 'm.message', 'm.email',
											'm.telephone', 'm.created_at', 'm.id')->get();
	}
}
