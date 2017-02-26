<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\ServerInfo;
use App\ServerLog;
use App\requestedServerLog;

class RequestServerlogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $serverInfo;

    /**
     * Create a new job instance.
     *
     * @param  ServerInfo  $serverInfo
     * @return void
     */
    public function __construct(ServerInfo $serverInfo)
    {
        $this->serverInfo = $serverInfo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $requestedServerLog = new requestedServerLog();
        $requestedServerLog->setDynamicConnection($this->serverInfo);
        $requestedValues = $requestedServerLog->all();

        $serverLog = new ServerLog();
        $serverLog->server_info_id = $this->serverInfo->id;

        foreach ($requestedValues as $logValue) {
            $serverLog->fillValuesFromRequested($logValue);
            $serverLog->save();
        }
        
    }
}
