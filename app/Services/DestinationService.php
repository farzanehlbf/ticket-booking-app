<?php

namespace App\Services;

use App\Contracts\Repositories\DestinationRepositoryInterface;

class DestinationService
{
    protected $destinationRepository;

    public function __construct(DestinationRepositoryInterface $destinationRepository)
    {
        $this->destinationRepository = $destinationRepository;
    }

    public function getAllDestinations(int $perPage = 15, array $filters = null): mixed
    {
        return $this->destinationRepository->paginate($perPage, $filters);
    }

    public function createDestination(array $data)
    {
        return $this->destinationRepository->create($data);
    }

    public function findDestination($id)
    {
        return $this->destinationRepository->find($id);
    }

    public function updateDestination(array $data, $id)
    {
        return $this->destinationRepository->update($data, $id);
    }

    public function deleteDestination($id)
    {
        return $this->destinationRepository->delete($id);
    }
}
