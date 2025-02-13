<?php

namespace App\Services;

use App\Models\Passenger;
use App\Models\Reservation;
use App\Models\Search;
use Carbon\Carbon;

class ReservationService
{
    public function reserve($request)
    {
        $search = Search::findOrFail($request->search_id);
        $expiryTime = Carbon::now()->addMinutes(15);

        // ایجاد رزرو
        $reservation = Reservation::create([
            'search_id' => $search->id,
            'passengers_count' => count($request->passengers_list),
            'chair_numbers' => $request->chair_numbers,
            'expiry_time' => $expiryTime,
            'status' => 'pending',
        ]);

        // افزودن مسافران به رزرو
        foreach ($request->passengers_list as $index => $passengerData) {
            $existingPassenger = Passenger::where('identity_id', $passengerData['identity_id'])->first();

            if ($existingPassenger) {
                $passenger = $existingPassenger;
            } else {
                $passenger = Passenger::create([
                    'first_name' => $passengerData['first_name'],
                    'last_name' => $passengerData['last_name'],
                    'identity_id' => $passengerData['identity_id'],
                    'phone_number' => $passengerData['phone_number'],
                ]);
            }

            // اتصال مسافر به رزرو
            $reservation->passengers()->attach($passenger->id, ['leader' => $index == 0]);
        }

        return $reservation;
    }

    /**
     * Cancel the reservation by ID.
     *
     * @param  int  $id
     * @return \App\Models\Reservation
     */
    public function cancel($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return null;
        }

        $reservation->update(['status' => 'cancelled']);
        return $reservation;
    }
}
