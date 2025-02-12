<?php

namespace App\Repositories;

use App\Contracts\Repositories\OriginRepositoryInterface;
use App\Models\Origin;
use Illuminate\Pagination\LengthAwarePaginator;

class OriginRepository implements OriginRepositoryInterface
{
    public function all()
    {
        return Origin::all();
    }

    public function create(array $data)
    {
        return Origin::create($data);
    }

    public function find($id)
    {
        return Origin::findOrFail($id);
    }

    public function update(array $data,$id)
    {
        $origin = $this->find($id);
        $origin->update($data);
        return $origin;
    }


    public function delete($id)
    {
        $origin = $this->find($id);
        $origin->delete();
        return true;
    }


    public function paginate(int $perPage = 15, array $filters = null): LengthAwarePaginator
    {
        $query = Origin::query();

        // اگر فیلترها وجود داشته باشد، آن‌ها را اضافه کنید
        if ($filters) {
            foreach ($filters as $key => $value) {
                $query->where($key, $value);
            }
        }

        return $query->paginate($perPage);
    }
}
