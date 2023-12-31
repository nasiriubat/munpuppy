<?php

namespace App\Traits;
use Illuminate\Http\Response;
/*
|--------------------------------------------------------------------------
| Api Response Trait
|--------------------------------------------------------------------------
|
| This trait will be used for any response we sent to clients.
|
 */

trait ApiResponse
{
    /*
     * @param  array $data
     * @return json
     */
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json(['data' => $data], $code);
    }

    public function errorResponse($data, $code = 404)
    {
        return response()->json(['error' => $data->message, 'code' => $code], $code);
    }

}
