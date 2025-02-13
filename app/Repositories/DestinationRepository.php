<?php
namespace App\Repositories;

use App\Contracts\Repositories\DestinationRepositoryInterface;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Model;

class DestinationRepository extends BaseRepository implements DestinationRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new Destination());
    }
}
