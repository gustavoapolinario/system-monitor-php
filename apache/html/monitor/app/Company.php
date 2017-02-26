<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the comments for the blog post.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * Get the comments for the blog post.
     */
    public function servers()
    {
        return $this->hasMany('App\ServerInfo');
    }
}
