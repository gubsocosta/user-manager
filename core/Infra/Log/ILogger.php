<?php

namespace Core\Infra\Log;

interface ILogger
{
    public function error(string $message);
    public function info(string $message);
}
