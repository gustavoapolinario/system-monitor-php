<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ServerInfo;
use App\Jobs\RequestServerlogJob;

class RequestServerlogCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:RequestServerlog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Request Server log Command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $serverInfoList = ServerInfo::all();

        foreach ($serverInfoList as $serverInfo) {
            dispatch(new RequestServerlogJob($serverInfo));
        }
    }
}
