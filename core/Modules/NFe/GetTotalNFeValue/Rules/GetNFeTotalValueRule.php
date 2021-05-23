<?php

namespace Core\Modules\NFe\GetTotalNFeValue\Rules;

use Core\Modules\NFe\GetTotalNFeValue\Exceptions\NFeNotFoundException;
use Core\Modules\NFe\GetTotalNFeValue\Gateways\FindNFeValueGateway;

class GetNFeTotalValueRule
{
    private FindNFeValueGateway $findNFeValueGateway;

    public function __construct(FindNFeValueGateway $findNFeValueGateway)
    {
        $this->findNFeValueGateway = $findNFeValueGateway;
    }

    public function apply(string $accessKey): float
    {
        try {
            return $this->findNFeValueGateway->get($accessKey);
        } catch (\Throwable $e) {
            throw new NFeNotFoundException($e);
        }
    }
}
