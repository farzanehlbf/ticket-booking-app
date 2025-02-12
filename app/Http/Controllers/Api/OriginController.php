<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOriginRequest;
use App\Http\Resources\OriginResource;
use App\Services\OriginService;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class OriginController extends Controller
{
    protected $originService;

    public function __construct(OriginService $originService)
    {
        $this->originService = $originService;
    }
    public function index()
    {
        $origins=$this->originService->getAllOrigins();
        return OriginResource::collection($origins);
    }

    public function store(StoreOriginRequest $request)
    {
        $origin=$this->originService->createOrigin($request->all());
        return response()->json([
            'message' => 'Origin created successfully.',
            'entity' => new OriginResource($origin),
        ], HttpResponse::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $updated=$this->originService->updateOrigin($request->all(), $id);
        if (!$updated) {
            return response()->json([
                'message' => 'Error updating origin.'
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Origin updated successfully.',
            'entity' => new OriginResource($updated),
        ], HttpResponse::HTTP_OK);
    }

    public function destroy($id)
    {
        $origin = $this->originService->findOrigin($id);

        if (!$origin) {
            return response()->json([
                'message' => 'Origin not found.'
            ], HttpResponse::HTTP_NOT_FOUND);
        }

        $deleted = $this->originService->deleteOrigin($id);

        if (!$deleted) {
            return response()->json([
                'message' => 'Error deleting origin.'
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Origin deleted successfully.'
        ], HttpResponse::HTTP_OK);
    }
}
