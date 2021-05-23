<?php


namespace Core\Modules\NFe\PushNFes\Rules;

use Core\Modules\NFe\PushNFes\Exceptions\NFeRetrievalException;
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
        try {
            return $this->pushNFeGateway->pushNFe();
        } catch (\Throwable $e) {
            throw new NFeRetrievalException($e);
        }
    }
}
