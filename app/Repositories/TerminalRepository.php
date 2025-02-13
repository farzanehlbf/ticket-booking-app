<?php

namespace App\Repositories;

use App\Contracts\Repositories\TerminalRepositoryInterface;
use App\Models\BusTerminal;
use App\Models\Terminal;
use Illuminate\Pagination\LengthAwarePaginator;

class TerminalRepository extends BaseRepository implements TerminalRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new BusTerminal());
    }

    public function getTerminalsByCityCode(array $cityCodes)
    {
        return $this->model->whereHas('origin', function ($query) use ($cityCodes) {
            $query->whereIn('city_code', $cityCodes); // فیلتر بر اساس city_code در مبدا
        })
            ->orWhereHas('destination', function ($query) use ($cityCodes) {
                $query->whereIn('city_code', $cityCodes); // فیلتر بر اساس city_code در مقصد
            })
            ->with(['origin', 'destination']) // بارگذاری روابط
            ->get();
    }


}
