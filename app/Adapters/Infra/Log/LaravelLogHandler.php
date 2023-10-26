<?php

namespace App\Adapters\Infra\Log;

use Core\Infra\Log\ILogHandler;
use Illuminate\Support\Facades\Log;

final class LaravelLogHandler implements ILogHandler
{
    public function error(string $message): void
    {
        Log::error($message);
    }

    public function info(string $message): void
    {
        Log::info($message);
    }
}
