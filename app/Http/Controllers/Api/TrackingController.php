<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Reservation;
use App\Models\Trip;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function track(Request $request)
    {
        // اعتبارسنجی ورودی‌ها
        $request->validate([
            'search_id' => 'nullable|exists:trips,id',
            'reservation_id' => 'nullable|exists:reservations,id',
            'ticket_number' => 'nullable|exists:tickets,ticket_number',
        ]);

        // اگر شناسه جستجو (search_id) داده شده باشد
        if ($request->has('search_id')) {
            $trip = Trip::with(['origin', 'destination', 'terminal', 'transportType'])
                ->findOrFail($request->search_id);
            return response()->json($trip);
        }

        // اگر شناسه رزرو (reservation_id) داده شده باشد
        if ($request->has('reservation_id')) {
            $reservation = Reservation::with(['trip', 'passengers'])
                ->findOrFail($request->reservation_id);
            return response()->json($reservation);
        }

        // اگر شماره بلیط (ticket_number) داده شده باشد
        if ($request->has('ticket_number')) {
            $ticket = Ticket::with(['passenger', 'reservation', 'trip'])
                ->where('ticket_number', $request->ticket_number)
                ->firstOrFail();
            return response()->json($ticket);
        }

        return response()->json(['error' => 'No valid search parameter provided'], 400);
    }
}
