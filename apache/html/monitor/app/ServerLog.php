<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerLog extends Model
{

	public $timestamps = false;

	public function fillValuesFromRequested($logValue) {
		$json = json_decode($logValue->value);

		$this->created_at = $logValue->time;
		$this->load_average = $json->loadAvg;
		$this->mem_info = $json->loadAvg;
		$this->mem_total = $json->memTotal;
		$this->mem_free = $json->memFree;
		$this->buffers = $json->buffers;
		$this->cached = $json->cached;
		$this->swap_total = $json->swapTotal;
		$this->swap_free = $json->swapFree;
		$this->uname = $json->uname;

		$this->qtd_querys = 0;
		$this->qtd_sleeps = 0;

	}


    /**
     * Get the user that owns the phone.
     */
    public function server()
    {
        return $this->belongsTo('App\ServerInfo');
    }

}
