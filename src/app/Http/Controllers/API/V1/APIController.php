<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Server(
 *      url="http://localhost:8000/api/v1",
 *      description="Maewin OpenApi Server"
 * )
 *
 * @OA\Info(
 *      version="1.0.0",
 *      title="Maewin API Documentation",
 *      description="API Documentation"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="Bearer",
 *     type="apiKey",
 *     name="Authorization",
 *     in="header"
 * )
 *
 */

class APIController extends Controller
{
    //
}
