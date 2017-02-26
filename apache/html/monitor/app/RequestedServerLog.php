<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestedServerLog extends BaseDynamicConnectionModel
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'logs';
}
