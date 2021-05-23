<?php

namespace App\Http\Controllers\NFe;

use App\Adapters\HttpClient\GuzzleClientAdapter;
use App\Adapters\Modules\NFe\NFePgsqlAdapter;
use App\Http\Controllers\BaseController;
use App\Http\Schema\V1\ErrorResponse;
use Core\Modules\NFe\PushNFes\UseCase;
use App\Http\Controllers\HttpClient;
use Illuminate\Http\JsonResponse;

class NFeController extends BaseController
{
    public function pushNFes(): JsonResponse
    {
        $useCase = new UseCase(new GuzzleClientAdapter(), new NFePgsqlAdapter());
        try {
            $response = $useCase->execute();

            if (is_array($response)) {
                return new JsonResponse([
                    'data' => $response[0],
                    'status' => [
                        'code' => 200,
                        'message' => sprintf('%s - Everything it is OK', env('APP_IDENTIFIER'))
                    ],
                ]);
            } else {
                return new JsonResponse([
                    'data' => [],
                    'status' => [
                        'code' => 200,
                        'message' => sprintf('%s - No NFes were found to be pushed', env('APP_IDENTIFIER'))
                    ],
                ]);
            }
        } catch (\Exception $e) {
            dump($e);
            return new JsonResponse([
                'data' => $e,
                'status' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                    ]
                ]);
        }
    }

    public function getTotalValueByAccessKey(string $accessKey): float
    {
    }
}
