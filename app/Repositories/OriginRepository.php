<?php

namespace App\Repositories;

use App\Contracts\Repositories\OriginRepositoryInterface;
use App\Models\Origin;

class OriginRepository extends BaseRepository implements OriginRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new Origin());
    }
}
