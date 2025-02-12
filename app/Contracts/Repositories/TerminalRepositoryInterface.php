<?php

namespace App\Contracts\Repositories;

interface TerminalRepositoryInterface extends BaseRepositoryInterface
{
    public function getTerminalsByCityCode(array $cityCodes);
}
