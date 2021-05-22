<?php

declare(strict_types=1);

namespace Core\Modules\NFe\PushNFes\Entities;

class NFe
{
    private string $accessKey;
    private float $totalValue;

    public function __construct(string $accessKey, float $totalValue)
    {
        $this->accessKey = $accessKey;
        $this->totalValue = $totalValue;
    }

    /**
     * @return string
     */
    public function getAccessKey(): string
    {
        return $this->accessKey;
    }

    /**
     * @return float
     */
    public function getTotalValue(): float
    {
        return $this->totalValue;
    }
}
