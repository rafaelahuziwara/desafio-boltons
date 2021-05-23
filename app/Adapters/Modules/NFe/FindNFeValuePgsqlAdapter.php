<?php

namespace App\Adapters\Modules\NFe;

use _HumbugBoxa991b62ce91e\React\Dns\RecordNotFoundException;
use App\Exceptions\NoDataFoundException;
use App\Model\NFe;
use Core\Modules\NFe\GetTotalNFeValue\Gateways\FindNFeValueGateway;

class FindNFeValuePgsqlAdapter implements FindNFeValueGateway
{
    private $nfeModel = NFe::class;

    public function apply(string $accessKey): float
    {
        $query = $this->nfeModel::select([
            'total_nfe_value',
        ])
            ->where(['access_key' => $accessKey]);

        if ($query->count() === 0) {
            throw new RecordNotFoundException();
        }

        $response = $query->first();
        return $response['total_nfe_value'];
    }
}
