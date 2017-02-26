<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relatorio
{

	protected $server_info_id;
    protected $redis_key;

    /**
     * Create a new instance.
     *
     * @param  Int  $server_info_id
     * @return void
     */
	public function __construct(Int $server_info_id) {
		$this->server_info_id = $server_info_id;
        $this->redis_key = "rel" . $server_info_id;
	}

    /**
     * Create a new instance.
     *
     * @return void
     */
    public function get() {
    	\Redis::lrange($this->redis_key, 0, 10);
    }

}
