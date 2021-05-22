<?php

namespace App\Adapters\Modules\NFe;

use Core\Modules\NFe\PushNFes\Gateways\SaveNFeGateway;

class SaveNFeEloquentAdapter implements SaveNFeGateway
{
    public function __construct()
    {
    }

    public function save(array $nfe): void
    {
        // TODO: Implement save() method.
    }
}
