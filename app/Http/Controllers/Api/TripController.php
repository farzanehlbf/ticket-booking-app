<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTripRequest;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use App\Services\TripService;
use Illuminate\Http\Request;

class TripController extends Controller
{

    protected $tripService;

    public function __construct(TripService $tripService)
    {
        $this->tripService = $tripService;
    }

    public function index()
    {
        $trips = $this->tripService->getAllTrips();
        return TripResource::collection($trips);
    }

    public function show($id)
    {
        $trip = $this->tripService->getTripById($id);
        return new TripResource($trip);
    }

    public function store(StoreTripRequest $request)
    {
        $trip = $this->tripService->createTrip($request);
        return new TripResource($trip, 201);
    }

    public function update(StoreTripRequest $request, $id)
    {
        $trip = $this->tripService->updateTrip($request, $id);
        return new TripResource($trip);
    }

    public function destroy($id)
    {
        $message = $this->tripService->deleteTrip($id);
        return response()->json($message);
    }
}
