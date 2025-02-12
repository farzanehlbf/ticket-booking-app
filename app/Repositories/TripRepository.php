<?php

namespace App\Repositories;

use App\Contracts\Repositories\TripRepositoryInterface;
use App\Models\Trip;

class TripRepository extends BaseRepository implements TripRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new Trip());
    }
}
