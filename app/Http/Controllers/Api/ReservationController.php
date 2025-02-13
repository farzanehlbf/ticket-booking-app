<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Resources\PassengerResource;
use App\Http\Resources\ReservationResource;
use App\Services\ReservationService;
use Illuminate\Http\Response as HttpResponse;

class ReservationController extends Controller
{
    protected $reservationService;

    // تزریق سرویس
    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function reserve(StoreReservationRequest $request)
    {
        try {
            // استفاده از سرویس برای رزرو
            $reservation = $this->reservationService->reserve($request);

            return response()->json([
                'message' => 'Reservation created successfully.',
                'entity' => new ReservationResource($reservation),
                'passengers' => PassengerResource::collection($reservation->passengers),
            ], HttpResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the reservation.',
                'error' => $e->getMessage(),
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function cancel($id)
    {
        try {
            // استفاده از سرویس برای کنسل کردن رزرو
            $reservation = $this->reservationService->cancel($id);

            if (!$reservation) {
                return response()->json([
                    'message' => 'Reservation not found.',
                ], HttpResponse::HTTP_NOT_FOUND);
            }

            return response()->json([
                'message' => 'Reservation has been cancelled successfully.',
                'reservation_id' => $reservation->id,
                'status' => $reservation->status,
            ], HttpResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while cancelling the reservation.',
                'error' => $e->getMessage(),
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
