<?php

namespace App\Services;

use App\Contracts\Repositories\TripRepositoryInterface;
use Illuminate\Http\Request;

class TripService
{
    protected $tripRepository;

    public function __construct(TripRepositoryInterface $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }
    public function getAllTrips(int $perPage = 15, array $filters = null): mixed
    {
        return $this->tripRepository->paginate($perPage, $filters);
    }

    public function getTripById($id)
    {
        return $this->tripRepository->find($id);
    }

    public function createTrip(Request $request)
    {
        return $this->tripRepository->create($request->all());
    }

    public function updateTrip(Request $request, $id)
    {
        return $this->tripRepository->update($id, $request->all());
    }

    public function deleteTrip($id)
    {
        return $this->tripRepository->delete($id);
    }
}
