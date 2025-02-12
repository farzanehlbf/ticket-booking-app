<?php

namespace App\Repositories;

use App\Contracts\Repositories\BaseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function all(array $filters = null, array $relations = null): Collection
    {
        $query = $this->model->newQuery();

        if ($filters) {
            $query->where($filters);
        }

        if ($relations) {
            $query->with($relations);
        }

        return $query->latest()->get();
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data): bool
    {
        $record = $this->find($id);

        if ($record) {
            return $record->update($data);
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        $record = $this->find($id);

        if ($record) {
            return $record->delete();
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function paginate(int $perPage = 15, array $filters = null, array $relations = null): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if ($filters) {
            $query->where($filters);
        }

        if ($relations) {
            $query->with($relations);
        }

        return $query->latest()->paginate($perPage);
    }
}
