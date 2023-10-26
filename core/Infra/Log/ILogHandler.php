<?php

namespace Core\Infra\Log;

interface ILogHandler
{
    public function error(string $message);
    public function info(string $message);
}
