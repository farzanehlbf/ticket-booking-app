<?php

namespace App\Repositories;

use App\Contracts\Repositories\TerminalRepositoryInterface;
use App\Models\Terminal;
use Illuminate\Pagination\LengthAwarePaginator;

class TerminalRepository extends BaseRepository implements TerminalRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new Terminal());
    }

    public function getTerminalsByCityCode(array $cityCodes)
    {
        return $this->model->whereHas('origin', function ($query) use ($cityCodes) {
            $query->whereIn('city_code', $cityCodes); // فیلتر بر اساس city_code
        })->with('origin')->get();
    }
}
