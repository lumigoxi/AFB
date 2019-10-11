<?php

namespace app;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use app\ActivityPicture;

class Activity extends Model
{
    //

 protected $fillable = [
        'activity', 'decription', 'date', 'idUser', 'located_at'
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

    public function pictures(){
        return $this->hasMany(ActivityPicture::class);
    }

    public static function getForFront(){

    
        return DB::table('activities as a')->select('a.activity', 'a.decription',  'a.date', 'p.path', 'a.located_at', 'a.id')
                                    ->leftjoin('activity_pictures as p','a.id', '=', 'p.activity_id')
                                    ->where('p.defPicture', '=', 1)
                                    ->where('a.status', '=', "1")
                                    ->where('a.date', '>=', Carbon::now())
                                    ->orderBy('a.date', 'asc')->get();
    }

    public static function deleteActivity($id){
        $pictures = DB::table('activity_pictures')->where('activity_id', '=', $id)->count();
        if ($pictures > 0) {
            $paths = DB::table('activity_pictures')->select('path')->where('activity_id', '=', $id)->get();
            foreach ($paths as $path) {
                    File::delete($path->path);
            }
        $RA = DB::table('activities')->whereId($id)->delete() ? 1:0;
        $RAP = DB::table('activity_pictures')->where('activity_id', '=', $id)->delete() ? 1:0;

        if ($RA == 1 && $RAP == 1) {
            return 1;
        }else{
            return 0;
        }
        }else{
            Activity::find($id)->delete();
        }
        
    }
}
