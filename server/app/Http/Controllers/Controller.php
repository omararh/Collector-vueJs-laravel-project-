<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="pilot4collector api documentation", version="1.0"),
 * @OA\Server(
 *      description="api-documentation",
 *      url="http://localhost:8000/api/"
 *  ),
 *     @OA\Components(
 *         @OA\SecurityScheme(
 *             securityScheme="bearerAuth",
 *             type="http",
 *             scheme="bearer",
 *             bearerFormat="JWT"
 *         ),
 *         @OA\SecurityScheme(
 *             securityScheme="ApiKeyAuth",
 *             type="apiKey",
 *             in="header",
 *             name="X-API-KEY"
 *         )
 *     )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
