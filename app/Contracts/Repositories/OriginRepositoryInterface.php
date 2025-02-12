<?php

namespace App\Contracts\Repositories;
use Illuminate\Pagination\LengthAwarePaginator;


interface OriginRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
    public function paginate(int $perPage = 15, array $filters = null): LengthAwarePaginator;

}
