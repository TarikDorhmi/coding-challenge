<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class LoggerService
{
    public function log($message)
    {
        if (config('app.env') === 'local') {
            Log::info($message);
        } else {
            Log::info(json_encode(['message' => $message]));
        }
    }
}
