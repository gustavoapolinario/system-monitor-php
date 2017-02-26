<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcessaRelatorio
{

	protected $serverLog;
    protected $redis_key;

    /**
     * Create a new instance.
     *
     * @param  ServerLog  $serverLog
     * @return void
     */
	public function __construct(ServerLog $serverLog) {
		$this->serverLog = $serverLog;
        $this->redis_key = "rel" . $serverLog->server_info_id;
	}

    /**
     * Create a new instance.
     *
     * @return void
     */
    public function processalog() {
    	\Redis::lpush($this->redis_key, json_encode($this->serverLog->toJson()));
    	\Redis::ltrim($this->redis_key, 0, 10);
    }

}
