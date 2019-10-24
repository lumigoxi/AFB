<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class PageImage extends Model
{
    //
	protected $fillable = [
        'page_id',
        'path'
    ];
}
