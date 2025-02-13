<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\Ticket;
use App\Models\Trip;

class TrackingService
{
    public function track(array $parameters)
    {
        if (isset($parameters['search_id'])) {
            return $this->trackBySearchId($parameters['search_id']);
        }

        if (isset($parameters['reservation_id'])) {
            return $this->trackByReservationId($parameters['reservation_id']);
        }

        if (isset($parameters['ticket_number'])) {
            return $this->trackByTicketNumber($parameters['ticket_number']);
        }

        return response()->json(['error' => 'No valid search parameter provided'], 400);
    }


    private function trackBySearchId($searchId)
    {
        $trip = Trip::with(['origin', 'destination', 'transportType'])
            ->findOrFail($searchId);
        return response()->json($trip);
    }


    private function trackByReservationId($reservationId)
    {
        $reservation = Reservation::with(['trip', 'passengers'])
            ->findOrFail($reservationId);
        return response()->json($reservation);
    }


    private function trackByTicketNumber($ticketNumber)
    {
        $ticket = Ticket::with(['passenger', 'reservation', 'trip'])
            ->where('ticket_number', $ticketNumber)
            ->firstOrFail();
        return response()->json($ticket);
    }
}
