<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
    * @OA\Info(
    *     description="Laravel API Documentation",
    *     version="1.0.0",
    *     title="Laravel API Documentation",
    * )
    */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
