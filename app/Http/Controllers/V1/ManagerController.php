<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Manager\IndexRequest;
use App\Http\Requests\V1\Manager\UpdateRequest;
use App\Http\Resources\LeadResource;
use App\Services\ManagerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function __construct(protected ManagerService $service)
    {
    }

    public function index(IndexRequest $request): JsonResponse
    {
        $res = $this->service->get($request->validated());

        return response()->successJson(LeadResource::collection($res));
    }

    public function getLead(int $id): JsonResponse
    {
        return response()->successJson($this->service->getLead($id));
    }

    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        return response()->successJson($this->service->edit($request->validated(), $id));
    }
}
