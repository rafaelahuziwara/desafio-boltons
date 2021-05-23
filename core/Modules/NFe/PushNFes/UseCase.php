<?php

namespace Core\Modules\NFe\PushNFes;

use Core\Dependencies\LogInterface;
use Core\Modules\NFe\PushNFes\Gateways\PushNFeGateway;
use Core\Modules\NFe\PushNFes\Gateways\SaveNFeGateway;
use Core\Modules\NFe\PushNFes\Rules\RetrieveNFeRule;
use Core\Modules\NFe\PushNFes\Rules\SaveNFeRule;

class UseCase
{
    private LogInterface $logger;
    private RetrieveNFeRule $retrieveNFeRule;
    private SaveNFeRule $saveNFeRule;

    public function __construct(LogInterface $logger, PushNFeGateway $pushNFeGateway, SaveNFeGateway $saveNFeGateway)
    {
        $this->logger = $logger;
        $this->retrieveNFeRule = new RetrieveNFeRule($pushNFeGateway);
        $this->saveNFeRule = new SaveNFeRule($saveNFeGateway);
    }

    public function execute(): void
    {
        try {
            $this->logger->info('*** PushNFes - Init Use Case ***');
            $nFes = $this->retrieveNFeRule->apply();

            $this->logger->info('*** PushNFes - Use Case - Retrieve NFes ***', [
                'client' => [
                    'nfes' => $nFes,
                ]
            ]);

            $this->saveNFeRule->apply($nFes);
            $this->logger->info('*** PushNFes - Use Case - Save NFes ***');
        } catch (Throwable $exception) {
            $this->logger->error('*** PushNFes - Error ***', [
                'exception' => $exception]);

            throw $exception;
        }
    }
}
