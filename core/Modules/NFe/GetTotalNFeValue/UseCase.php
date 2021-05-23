<?php


namespace Core\Modules\NFe\GetTotalNFeValue;


use Core\Modules\NFe\GetTotalNFeValue\Gateways\FindNFeValueGateway;

class UseCase
{
    private FindNFeValueGateway $findNFeValueGateway;

    public function __construct(FindNFeValueGateway $findNFeValueGateway)
    {
        $this->findNFeValueGateway = $findNFeValueGateway;
    }

    public function execute(string $accessKey): float
    {
        try {
            $totalValue = $this->findNFeValueGateway->apply($accessKey);

            if (!empty($totalValue)) {
                return $totalValue;
            }
        } catch (Throwable $exception) {
            throw $exception;
        }
    }
}
