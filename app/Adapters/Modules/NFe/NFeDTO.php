<?php

namespace App\Adapters\Modules\NFe;

use Core\Modules\NFe\PushNFes\Entities\NFe;
use PHPUnit\Util\Xml\Exception;
use Spatie\DataTransferObject\FlexibleDataTransferObject;

class NFeDTO extends FlexibleDataTransferObject
{
    public function __construct()
    {
    }

    public function fromJson(string $json): array
    {
        try {
            $data = json_decode($json, true);
            $nfes = array();
            foreach ($data['data'] as $d) {
                $accessKey = $d['access_key'];
                $decodedXmlString = base64_decode($d['xml']);
                $xml = simplexml_load_string($decodedXmlString);
                $vnf = floatval(strval($xml->NFe->infNFe->total->ICMSTot->vNF[0]));

                array_push($nfes, new NFe(
                    $accessKey,
                    $vnf
                ));
            }
            return $nfes;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }
}
