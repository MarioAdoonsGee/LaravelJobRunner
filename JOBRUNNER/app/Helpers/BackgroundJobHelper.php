<?php

use App\BackgroundJobs\JobRunner;

function runBackgroundJob(string $className, string $method, array $parameters = [])
{
    // Handle Unix-based systems
    if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
        $command = 'php ' . base_path('artisan') . " job:run \"$className\" \"$method\" \"" . base64_encode(json_encode($parameters)) . "\" > /dev/null &";
    } else {
        // Handle Windows systems
        $command = 'start /B php ' . base_path('artisan') . " job:run \"$className\" \"$method\" \"" . base64_encode(json_encode($parameters)) . "\"";
    }

    // Execute the command
    exec($command);
}
