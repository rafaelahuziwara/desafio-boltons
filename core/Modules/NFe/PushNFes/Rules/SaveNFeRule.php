<?php

namespace Core\Modules\NFe\PushNFes\Rules;

use Core\Modules\NFe\PushNFes\Gateways\SaveNFeGateway;

final class SaveNFeRule
{
    private SaveNFeGateway $saveNFeGateway;

    public function __construct(SaveNFeGateway $saveNFeGateway)
    {
        $this->saveNFeGateway = $saveNFeGateway;
    }

    public function apply(array $nFes): void
    {
        $this->saveNFeGateway->saveAll($nFes);
    }
}
