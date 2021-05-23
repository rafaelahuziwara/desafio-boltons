<?php

namespace Core\Modules\NFe\GetTotalNFeValue\Gateways;

interface FindNFeValueGateway
{
    public function apply(string $accessKey): float;
}
