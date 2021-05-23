<?php

namespace App\Http\Controllers;

use Core\Dependencies\LogInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    protected LogInterface $logger;

    public function __construct(LogInterface $logger)
    {
        $this->logger = $logger;
    }
}
