<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
	protected $fillable = ['name', 'lastName', 'telephone', 'email', 'reason', 'message', 'contactTel', 'contactEmail'];
}
