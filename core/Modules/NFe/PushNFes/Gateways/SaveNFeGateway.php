<?php

namespace Core\Modules\NFe\PushNFes\Gateways;

interface SaveNFeGateway
{
    public function save(array $nfes): void;
}
