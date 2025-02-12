<?php

namespace App\Services;

use App\Contracts\Repositories\OriginRepositoryInterface;

class OriginService
{
    protected $originRepository;

    public function __construct(OriginRepositoryInterface $originRepository)
    {
        $this->originRepository = $originRepository;
    }


    public function getAllOrigins(int $perPage = 15, array $filters = null): mixed
    {
        return $this->originRepository->paginate($perPage, $filters);
    }


    public function createOrigin(array $data)
    {
        return $this->originRepository->create($data);
    }
    public function findOrigin($id)
    {
        return $this->originRepository->find($id);
    }

    public function updateOrigin($id, array $data)
    {
        return $this->originRepository->update($data, $id);
    }

    public function deleteOrigin($id)
    {
        return $this->originRepository->delete($id);
    }
}
