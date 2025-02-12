<?php

namespace App\Services;
use App\Models\Terminal;
use Illuminate\Database\Eloquent\Collection;

use App\Contracts\Repositories\TerminalRepositoryInterface;

class TerminalService
{
    protected $terminalRepository;

    public function __construct(TerminalRepositoryInterface $terminalRepository)
    {
        $this->terminalRepository = $terminalRepository;
    }

    public function getAllTerminals(int $perPage = 15, array $filters = null): mixed
    {
        return $this->terminalRepository->paginate($perPage, $filters);
    }


    public function createTerminal(array $data)
    {
        return $this->terminalRepository->createTerminal($data);
    }

    public function updateTerminal(array $data, int $id)
    {
        return $this->terminalRepository->updateTerminal($data, $id);
    }

    public function findTerminal(int $id)
    {
        return $this->terminalRepository->findTerminal($id);
    }

    public function deleteTerminal(int $id)
    {
        return $this->terminalRepository->deleteTerminal($id);
    }

    public function getTerminalsByCityCode(array $cityCode)
    {
        return $this->terminalRepository->getTerminalsByCityCode($cityCode);
    }
}
