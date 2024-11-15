<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\BackgroundJobs\JobRunner;

class RunBackgroundJob extends Command
{
    protected $signature = 'job:run {className} {method} {parameters}';
    protected $description = 'Run a background job';

    public function handle()
    {
        $className = $this->argument('className');
        $method = $this->argument('method');
        $parameters = json_decode(base64_decode($this->argument('parameters')), true);

        JobRunner::run($className, $method, $parameters);
    }
}
