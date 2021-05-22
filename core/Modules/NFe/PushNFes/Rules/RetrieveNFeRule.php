<?php


namespace Core\Modules\NFe\PushNFes\Rules;

use Core\Modules\NFe\PushNFes\Gateways\PushNFeGateway;

class RetrieveNFeRule
{
    private PushNFeGateway $pushNFeGateway;

    public function __construct(PushNFeGateway $pushNFeGateway)
    {
        $this->pushNFeGateway = $pushNFeGateway;
    }

    public function apply(): array
    {
        return $this->pushNFeGateway->pushNFe();
    }
}
