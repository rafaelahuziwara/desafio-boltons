<?php

namespace App\Adapters\Log;

use Core\Dependencies\LogInterface;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class MonologLogAdapter implements LogInterface
{
    private Logger $logger;

    public function __construct()
    {
        $isDebugEnabled = env('APP_DEBUG', true);
        if ($isDebugEnabled) {
            $loggerType = Logger::DEBUG;
        } else {
            $loggerType = Logger::INFO;
        }

        $handler = new StreamHandler('php://stdout', $loggerType);
        $handler->setFormatter(new JsonFormatter());

        $this->logger = (new Logger('desafio-boltons_log'))
            ->pushHandler($handler);
    }

    public function emergency($message, array $context = []): void
    {
        $this->logger->emergency($message, $context);
    }

    public function alert($message, array $context = []): void
    {
        $this->logger->alert($message, $context);
    }

    public function critical($message, array $context = []): void
    {
        $this->logger->critical($message, $context);
    }

    public function error($message, array $context = []): void
    {
        $this->logger->error($message, $context);
    }

    public function warning($message, array $context = []): void
    {
        $this->logger->warning($message, $context);
    }

    public function notice($message, array $context = []): void
    {
        $this->logger->notice($message, $context);
    }

    public function info($message, array $context = []): void
    {
        $this->logger->info($message, $context);
    }

    public function debug($message, array $context = []): void
    {
        $this->logger->debug($message, $context);
    }
}
