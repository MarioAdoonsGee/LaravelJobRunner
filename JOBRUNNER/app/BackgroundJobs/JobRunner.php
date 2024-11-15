<?php

namespace App\BackgroundJobs;

use Exception;
use Illuminate\Support\Facades\Log;

class JobRunner
{
    public static function run(string $className, string $method, array $parameters = [])
    {
        try {
            if (!class_exists($className)) {
                throw new Exception("Class $className does not exist.");
            }

            $classInstance = new $className;

            if (!method_exists($classInstance, $method)) {
                throw new Exception("Method $method does not exist in class $className.");
            }

            // Execute the method with parameters
            $result = call_user_func_array([$classInstance, $method], $parameters);

            // Log success
            Log::info("Background job executed successfully", [
                'class' => $className,
                'method' => $method,
                'parameters' => $parameters,
                'result' => $result,
                'status' => 'success',
                'timestamp' => now()
            ]);
        } catch (Exception $e) {
            // Log error
            Log::error("Background job execution failed", [
                'class' => $className,
                'method' => $method,
                'parameters' => $parameters,
                'error' => $e->getMessage(),
                'status' => 'failed',
                'timestamp' => now()
            ]);

            // Retry logic can be implemented here (if needed)
        }
    }
}
