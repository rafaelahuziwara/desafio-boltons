<?php

namespace Core\Modules\NFe\PushNFes\Gateways;

interface SaveNFeGateway
{
    public function saveAll(array $nFes): void;
}
