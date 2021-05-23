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

    public function execute(): array
    {
        try {
            $nFes = $this->retrieveNFeRule->apply();
            $this->saveNFeRule->apply($nFes);

            if (!empty($nFes)) {
                return $nFes;
            }
        } catch (Throwable $exception) {
            throw $exception;
        }
    }
}
