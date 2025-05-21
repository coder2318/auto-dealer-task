<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Lead\StoreRequest;
use App\Services\LeadService;
use Illuminate\Http\JsonResponse;

class LeadController extends Controller
{
    public function __construct(protected LeadService $service)
    {
    }

    public function createLead(StoreRequest $request): JsonResponse
    {
        $res = $this->service->create($request->validated());

        return response()->successJson($res);
    }
}
