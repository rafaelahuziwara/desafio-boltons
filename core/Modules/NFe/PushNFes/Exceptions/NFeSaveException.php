<?php

namespace Core\Modules\NFe\PushNFes\Exceptions;

use Throwable;
use Illuminate\Http\Response;

class NFeSaveException extends \DomainException
{
    public function __construct($message = "Error finding NFe with informed access key.", $code = Response::HTTP_BAD_REQUEST, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
