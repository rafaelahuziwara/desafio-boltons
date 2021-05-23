<?php

namespace Core\Modules\NFe\GetTotalNFeValue;

use Core\Dependencies\LogInterface;
use Core\Modules\NFe\GetTotalNFeValue\Gateways\FindNFeValueGateway;

class UseCase
{
    private LogInterface $logger;
    private FindNFeValueGateway $findNFeValueGateway;

    public function __construct(LogInterface $logger, FindNFeValueGateway $findNFeValueGateway)
    {
        $this->logger = $logger;
        $this->findNFeValueGateway = $findNFeValueGateway;
    }

    public function execute(string $accessKey): float
    {
        try {
            $this->logger->info('*** GetTotalNFeValue - Init Use Case ***', [
                'client' => [
                    'access_key' => $accessKey,
                ]
            ]);

            $totalValue = $this->findNFeValueGateway->apply($accessKey);

            if (!empty($totalValue)) {
                return $totalValue;
            }
        } catch (Throwable $exception) {
            $this->logger->error('*** GetTotalNFeValue - Error ***', [
                'exception' => $exception,
                'client' => [
                    'access_key' => $accessKey,
                ]
            ]);

            throw $exception;
        }
    }
}
