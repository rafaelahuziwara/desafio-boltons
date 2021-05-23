<?php

namespace App\Adapters\Modules\NFe;

use App\Model\NFe;
use Core\Modules\NFe\PushNFes\Gateways\SaveNFeGateway;

class NFePgsqlAdapter implements SaveNFeGateway
{
    /**
     * @var string
     */
    private $nfeModel = NFe::class;

    public function saveAll(array $nFes): void
    {
        $bulk = [];
        foreach ($nFes as $nfe) {
            $bulk = [
                'access_key' => $nfe->getAccessKey(),
                'total_nfe_value' => $nfe->getTotalValue()
            ];
        }
        $this->nfeModel::insert($bulk);
    }
}
