<?php

namespace Core\Modules\NFe\PushNFes\Exceptions;

use Throwable;
use Illuminate\Http\Response;

class NFeRetrievalException extends \DomainException
{
    public function __construct($message = "Error retrieving NFes from server.", $code = Response::HTTP_INTERNAL_SERVER_ERROR, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
