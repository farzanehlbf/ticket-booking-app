<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrackRequest;
use App\Models\Ticket;
use App\Models\Reservation;
use App\Models\Trip;
use App\Services\TrackingService;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    protected $trackingService;

    public function __construct(TrackingService $trackingService)
    {
        $this->trackingService = $trackingService;
    }


    public function track(TrackRequest $request)
    {
        return $this->trackingService->track($request->all());
    }
}
