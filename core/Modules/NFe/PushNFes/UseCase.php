<?php

namespace Core\Modules\NFe\PushNFes;

use Core\Modules\NFe\PushNFes\Gateways\PushNFeGateway;
use Core\Modules\NFe\PushNFes\Gateways\SaveNFeGateway;
use Core\Modules\NFe\PushNFes\Rules\RetrieveNFeRule;
use Core\Modules\NFe\PushNFes\Rules\SaveNFeRule;

class UseCase
{
    private RetrieveNFeRule $retrieveNFeRule;
    private SaveNFeRule $saveNFeRule;

    public function __construct(PushNFeGateway $pushNFeGateway, SaveNFeGateway $saveNFeGateway)
    {
        $this->retrieveNFeRule = new RetrieveNFeRule($pushNFeGateway);
        $this->saveNFeRule = new SaveNFeRule($saveNFeGateway);
    }

    public function execute(): string
    {
        try {
            $nfes = $this->retrieveNFeRule->apply();
            $this->saveNFeRule->apply($nfes);

            return $nfes[0]->getAccessKey();
        } catch (Throwable $exception) {
            throw $exception;
        }
    }
}
