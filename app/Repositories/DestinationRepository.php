<?php

namespace App\Repositories;

use App\Contracts\Repositories\DestinationRepositoryInterface;
use App\Models\Destination;
use Illuminate\Pagination\LengthAwarePaginator;

class DestinationRepository implements DestinationRepositoryInterface
{

    public function all()
    {
        return Destination::all();
    }

    public function create(array $data)
    {
        return Destination::create($data);
    }

    public function find($id)
    {
        return Destination::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $destination = $this->find($id);
        $destination->update($data);
        return $destination;
    }

    public function delete($id)
    {
        $destination = $this->find($id);
        $destination->delete();
        return true;
    }

    public function paginate(int $perPage = 15, array $filters = null): LengthAwarePaginator
    {
        $query = Destination::query();

        // If filters exist, apply them
        if ($filters) {
            foreach ($filters as $key => $value) {
                $query->where($key, $value);
            }
        }

        return $query->paginate($perPage);
    }
}
