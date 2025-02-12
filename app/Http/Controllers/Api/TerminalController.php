<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetTerminalsByCityCodeRequest;
use App\Http\Requests\StoreTerminalRequest;
use App\Http\Resources\TerminalResource;
use App\Services\TerminalService;
use Illuminate\Http\Response as HttpResponse;


class TerminalController extends Controller
{
    protected $terminalService;

    public function __construct(TerminalService $terminalService)
    {
        $this->terminalService = $terminalService;
    }

    public function index()
    {
        $terminals = $this->terminalService->getAllTerminals();
        return TerminalResource::collection($terminals);

    }

    public function store(StoreTerminalRequest $request)
    {
        $terminal = $this->terminalService->createTerminal($request->validated());
        return response()->json([
            'message' => 'Terminal created successfully.',
            'entity' => new TerminalResource($terminal),
        ], HttpResponse::HTTP_CREATED);
    }

    public function update(StoreTerminalRequest $request, $id)
    {
        $updated = $this->terminalService->updateTerminal($request->validated(), $id);
        if (!$updated) {
            return response()->json([
                'message' => 'Error updating terminal.'
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Terminal updated successfully.',
            'entity' => new TerminalResource($updated),
        ], HttpResponse::HTTP_OK);
    }

    public function destroy($id)
    {
        $terminal = $this->terminalService->findTerminal($id);

        if (!$terminal) {
            return response()->json([
                'message' => 'Terminal not found.'
            ], HttpResponse::HTTP_NOT_FOUND);
        }

        $deleted = $this->terminalService->deleteTerminal($id);

        if (!$deleted) {
            return response()->json([
                'message' => 'Error deleting terminal.'
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Terminal deleted successfully.'
        ], HttpResponse::HTTP_OK);
    }

    public function getTerminalsByCityCode(GetTerminalsByCityCodeRequest $request)
    {
        $terminals = $this->terminalService->getTerminalsByCityCode($request->validated());
        return TerminalResource::collection($terminals);
    }

}
