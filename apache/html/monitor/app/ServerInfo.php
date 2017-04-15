<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServerInfo extends Model
{
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * Get the user that owns the phone.
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }


    /**
     * Get the comments for the blog post.
     */
    public function serversLog()
    {
        return $this->hasMany('App\ServerInfo');
    }

    static function getMyServers() {
        $server = new ServerInfo();
        return $server->where('company_id', \Auth::user()->company()->first()->id)->get();
    }



    static function valuesForLog($serverInfo) {
        $obj = new \stdClass();
        $obj->id = $serverInfo->id;
        $obj->name = $serverInfo->name;
        $obj->host = $serverInfo->host;
        $obj->database = $serverInfo->database;
        $obj->company_id = $serverInfo->company_id;
        
        return $obj;
    }

}
