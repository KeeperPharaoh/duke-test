<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckUnloadRequest;
use App\Services\CheckServices;
use Illuminate\Http\JsonResponse;

class CheckController extends Controller
{
    private CheckServices $checkServices;

    public function __construct(CheckServices $checkServices)
    {
        $this->checkServices = $checkServices;
    }

    public function show(): JsonResponse
    {
        $result = $this->checkServices->show();
        return response()->json($result['message'],$result['code']);
    }

    public function unload(CheckUnloadRequest $request): JsonResponse
    {
        $result = $this->checkServices->unload($request->validated());
        return response()->json($result['message'],$result['code']);
    }
}
