<?php

namespace App\Models\Services;

use App\Models\Http\JsonRpcResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JsonRpcServer
{
    public function handle(Request $request, Controller $controller)
    {
        try {
            $content = json_decode($request->getContent(), true);

            if (empty($content)) {
                throw new \Exception('Parse error');
            }
            $result = $controller->{$content['method']}(...[$content['params']]);

            return JsonRpcResponse::success($result, $content['id']);
        } catch (\Exception $e) {
            return JsonRpcResponse::error($e->getMessage());
        }
    }
}
