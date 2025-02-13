<?php

namespace App\Services;

use App\Models\Passenger;
use App\Models\Reservation;
use App\Models\Ticket;
use Carbon\Carbon;

class BookingService
{
    public function bookTickets($reservationId, $passengersList)
    {
        $reservation = Reservation::findOrFail($reservationId);

        $tickets = [];

        foreach ($passengersList as $passengerData) {
            // Create or find the passenger
            $passenger = Passenger::firstOrCreate(
                ['identity_id' => $passengerData['identity_id']],
                [
                    'first_name' => $passengerData['first_name'],
                    'last_name' => $passengerData['last_name'],
                    'phone_number' => $passengerData['phone_number'],
                ]
            );

            // Create the ticket
            $ticket = Ticket::create([
                'reservation_id' => $reservation->id,
                'passenger_id' => $passenger->id,
                'ticket_number' => strtoupper(uniqid('TICKET-')),
                'identity_id' => $passenger->identity_id,
                'trip_id' => $reservation->trip_id,
            ]);

            $tickets[] = $ticket;
        }

        return $tickets;
    }


    public function refundTicket($ticketId)
    {
        $ticket = Ticket::find($ticketId);

        if (!$ticket) {
            return response()->json(['error' => 'Ticket not found'], 404);
        }

        if (Carbon::now()->diffInHours($ticket->created_at) > 24) {
            return response()->json(['error' => 'Ticket cannot be refunded. It is past the refund window.'], 400);
        }

        $ticket->status = 'cancelled';
        $ticket->cancellation_date = Carbon::now();
        $ticket->save();

        return response()->json(['message' => 'Ticket refunded successfully.'], 200);
    }
}
