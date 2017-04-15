<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\ServerInfo;
use App\ServerLog;
use App\RequestedServerLog;
use App\ProcessaRelatorio;

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

    private function logRequest($type, $requestedValues) {


        $times = array();
        foreach ($requestedValues as $logValue) {
            $times[] = $logValue->time;
        }

        $log = array(
            'serverInfo' => ServerInfo::valuesForLog($this->serverInfo),
            'returnCount' => count($requestedValues),
            'timesReturned' => $times,
        );

        $text = json_encode($log) . "\n";

        \App\MyLog::persist('Cron-RequestServerlogJob', $type, $text);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $requestedServerLog = new RequestedServerLog();
        $requestedServerLog->setDynamicConnection($this->serverInfo);
        $requestedValues = $requestedServerLog->all();

        $this->logRequest("info", $requestedValues);
        

        foreach ($requestedValues as $logValue) {
            $serverLog = new ServerLog();
            $serverLog->server_info_id = $this->serverInfo->id;
            $serverLog->fillValuesFromRequested($logValue);
            $serverLog->save();

            $processaRelatorio = new ProcessaRelatorio($serverLog);
            $processaRelatorio->processalog();

            $logValue->delete();
        }
        
    }
}
