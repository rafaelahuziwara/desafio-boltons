<?php

namespace Tests\core\Modules\NFe\GetTotalNFeValue\Rules;

use Core\Modules\NFe\GetTotalNFeValue\Exceptions\NFeNotFoundException;
use Core\Modules\NFe\GetTotalNFeValue\Gateways\FindNFeValueGateway;
use Core\Modules\NFe\GetTotalNFeValue\Rules\GetNFeTotalValueRule;
use Tests\TestCase;

class GetNFeTotalValueRuleTest extends TestCase
{
    public function applyExceptionTest()
    {
        $this->expectException(NFeNotFoundException::class);

        $findNFeValueGateway = $this->createMock(FindNFeValueGateway::class);
        $findNFeValueGateway->method('get')->willThrowException(new \Exception());

        (new GetNFeTotalValueRule($findNFeValueGateway))->apply("99999999999999999999999999999999999999999999");
    }
}
