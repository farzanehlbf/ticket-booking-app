<?php
namespace App\Repositories;

use App\Contracts\Repositories\DestinationRepositoryInterface;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Model;

class DestinationRepository extends BaseRepository implements DestinationRepositoryInterface
{
    /**
     * ProductRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }
}
