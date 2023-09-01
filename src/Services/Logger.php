<?php

namespace App\Services;

class Logger
{
    const LOG_INFO = '[Info]';
    const LOG_WARNING = '[Warning]';
    const LOG_ERROR = '[Error]';

    protected string $path;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/app.php';
        $logDir = $config['log_dir'] ?? __DIR__ . '/../../var/';
        $logFile = $config['log_file'] ?? 'log.txt';

        if (!is_dir($logDir)) mkdir($logDir);

        $this->path = $logDir . $logFile;
    }

    public function log(string $message, string $level = Logger::LOG_INFO): void
    {
        $log = date('Y-m-d H:i:s') . ' - ' . $level . ' : ' . $message . PHP_EOL;
        file_put_contents($this->path, $log, FILE_APPEND);
    }
}