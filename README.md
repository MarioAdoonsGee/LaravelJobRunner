# LaravelJobRunner

Setup and Configuration ***
1. Helper Function: Register BackgroundJobHelper.php in composer.json under autoload and run composer dump-autoload.
2. Approved Classes: List classes allowed for execution in config/background_jobs.php.

Usage Guide ***
Function: runBackgroundJob(string $className, string $method, array $parameters = [])

Error Handling and Logging ***
Success Logs: storage/logs/laravel.log
Error Logs: storage/logs/background_jobs_errors.log
Retries: Implement retry logic in JobRunner.php to attempt job execution multiple times.

Retry Mechanism ***
Configure retries by passing a maxRetries argument.
Example retry implementation checks for failures and logs each attempt.

Delays and Priorities ***
Delays: Use sleep(seconds) before runBackgroundJob for delayed execution.
Priorities: Pass and handle priority arguments in your job logic to control execution order.

Security Considerations ***
Whitelisting: Restrict to approved classes and methods in config/background_jobs.php.
Validation: Ensure parameters are sanitized to prevent security risks.
