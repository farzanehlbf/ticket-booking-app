<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinationRequest;
use App\Http\Resources\DestinationResource;
use App\Services\DestinationService;
use Illuminate\Http\Response as HttpResponse;


class DestinationController extends Controller
{
    protected $destinationService;

    public function __construct(DestinationService $destinationService)
    {
        $this->destinationService = $destinationService;
    }

    public function index()
    {
        $destinations = $this->destinationService->getAllDestinations();
        return DestinationResource::collection($destinations);
    }

    public function store(StoreDestinationRequest $request)
    {
        $destination = $this->destinationService->createDestination($request->all());
        return response()->json([
            'message' => 'Destination created successfully.',
            'entity' => new DestinationResource($destination),
        ], HttpResponse::HTTP_CREATED);
    }

    public function update(StoreDestinationRequest $request, $id)
    {
        $updated = $this->destinationService->updateDestination($request->all(), $id);
        if (!$updated) {
            return response()->json([
                'message' => 'Error updating destination.'
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Destination updated successfully.',
            'entity' => new DestinationResource($updated),
        ], HttpResponse::HTTP_OK);
    }

    public function destroy($id)
    {
        $destination = $this->destinationService->findDestination($id);

        if (!$destination) {
            return response()->json([
                'message' => 'Destination not found.'
            ], HttpResponse::HTTP_NOT_FOUND);
        }

        $deleted = $this->destinationService->deleteDestination($id);

        if (!$deleted) {
            return response()->json([
                'message' => 'Error deleting destination.'
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Destination deleted successfully.'
        ], HttpResponse::HTTP_OK);
    }
}
