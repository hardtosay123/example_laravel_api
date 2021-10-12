<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function responseJson($data, $code)
    {
        $header = [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8',
            // 'Access-Control-Allow-Origin' => '*',
            // 'Access-Control-Allow-Methods' => '*',
            // 'Access-Control-Allow-Headers' => '*'
        ];
        return response()->json($data, $code, $header, JSON_UNESCAPED_UNICODE);
    }
}
