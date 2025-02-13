<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Services\BookingService;
use Illuminate\Http\Response as HttpResponse;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }


    public function booking(BookingRequest $request)
    {
        $tickets = $this->bookingService->bookTickets(
            $request->reserve_id,
            $request->passengers_list
        );

        return response()->json([
            'message' => 'Tickets booked successfully',
            'tickets' => $tickets,
        ], HttpResponse::HTTP_OK);
    }


    public function refund($ticketId)
    {
        return $this->bookingService->refundTicket($ticketId);
    }
}
