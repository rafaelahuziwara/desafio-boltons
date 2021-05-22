<?php

namespace App\Http\Controllers\NFe;

use App\Adapters\HttpClient\GuzzleClientAdapter;
use App\Adapters\Modules\NFe\SaveNFeEloquentAdapter;
use App\Http\Controllers\BaseController;
use Core\Modules\NFe\PushNFes\UseCase;
use App\Http\Controllers\HttpClient;

class NFeController extends BaseController
{
    public function pushNFes(): string
    {
        $useCase = new UseCase(new GuzzleClientAdapter(), new SaveNFeEloquentAdapter());
        try {
            return $useCase->execute();
        } catch (\Exception $e) {
            dump($e);
            return 'ERROR';
        }

        return 'FIM';
    }

    public function getTotalValueByAccessKey(string $accessKey): float
    {
    }
}
