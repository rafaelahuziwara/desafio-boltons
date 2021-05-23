<?php

namespace Core\Modules\NFe\GetTotalNFeValue\Exceptions;

use Throwable;
use Illuminate\Http\Response;

class NFeNotFoundException extends \DomainException
{
    public function __construct($message = "Error finding NFe with informed access key.", $code = Response::HTTP_NOT_FOUND, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
