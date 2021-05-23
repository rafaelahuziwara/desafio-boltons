<?php

namespace App\Http\Controllers\NFe;

use App\Adapters\HttpClient\GuzzleClientAdapter;
use App\Adapters\Log\MonologLogAdapter;
use App\Adapters\Modules\NFe\FindNFeValuePgsqlAdapter;
use App\Adapters\Modules\NFe\NFePgsqlAdapter;
use App\Http\Controllers\BaseController;
use App\Http\Schema\V1\ErrorResponse;
use Core\Modules\NFe\PushNFes\UseCase;
use App\Http\Controllers\HttpClient;
use Illuminate\Http\JsonResponse;

class NFeController extends BaseController
{
    protected MonologLogAdapter $logAdapter;

    public function __construct(MonologLogAdapter $logAdapter)
    {
        $this->logAdapter = $logAdapter;
    }

    public function pushNFes(): JsonResponse
    {

        $useCase = new UseCase($this->logAdapter, new GuzzleClientAdapter(), new NFePgsqlAdapter());
        try {
            $useCase->execute();

            return new JsonResponse([
                'status' => [
                    'code' => 200
                ]
            ]);
        } catch (\Exception $e) {
            $this->logAdapter->critical(
                'Something went wrong at pushNFes.',
                [
                    'exception' => $e
                ]
            );

            return new JsonResponse([
                'data' => $e,
                'status' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                    ]
                ]);
        }
    }

    public function getTotalValueByAccessKey(string $accessKey): JsonResponse
    {
        $useCase = new \Core\Modules\NFe\GetTotalNFeValue\UseCase($this->logAdapter, new FindNFeValuePgsqlAdapter());

        try {
            $response = $useCase->execute($accessKey);

            return new JsonResponse([
                'status' => [
                    'code' => 200
                ],
                'access_key' => $accessKey,
                'total_nfe_value' => $response
            ]);
        } catch (\Exception $e) {
            $this->logAdapter->critical(
                'Something went wrong at getTotalValueByAccessKey.',
                [
                    'exception' => $e,
                    'client' => [
                        'access_key' => $accessKey
                    ]
                ]
            );

            return new JsonResponse([
                'status' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ],
                'data' => $e,
            ]);
        }
    }
}
