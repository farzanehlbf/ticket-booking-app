<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Passenger;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function reserve(Request $request)
    {
        // اعتبارسنجی ورودی‌ها
        $request->validate([
            'search_id' => 'required|exists:trips,id',  // سفر باید موجود باشد
            'passengers_count' => 'required|integer|min:1',
            'chair_numbers' => 'required|array',
            'passengers_list' => 'required|array',  // لیست مسافران جدید
        ]);

        // پیدا کردن سفر بر اساس search_id
        $trip = Trip::findOrFail($request->search_id);


        // ایجاد رزرو جدید
        $reservation = Reservation::create([
            'trip_id' => $trip->id,
            'passengers_count' => $request->passengers_count,
            'chair_numbers' => json_encode($request->chair_numbers),
        ]);

        // اضافه کردن مسافران به رزرو
        foreach ($request->passengers_list as $passengerData) {
            $passenger = Passenger::create([
                'first_name' => $passengerData['first_name'],
                'last_name' => $passengerData['last_name'],
                'identity_id' => $passengerData['identity_id'],
                'phone_number' => $passengerData['phone_number'],
            ]);
            // ارتباط دادن مسافر به رزرو
            $reservation->passengers()->attach($passenger);
        }

        // تنظیم زمان انقضای رزرو به 15 دقیقه
        $reservation->expires_at = Carbon::now()->addMinutes(15);
        $reservation->save();

        // بازگشت شناسه رزرو
        return response()->json(['reservation_id' => $reservation->id]);
    }


    public function cancel($id)
    {
        
        $reservation = Reservation::findOrFail($id);

        // اگر رزرو منقضی شده باشد، خطا برمی‌گرداند
        if (Carbon::now()->greaterThan($reservation->expires_at)) {
            return response()->json(['error' => 'Reservation has expired'], 400);
        }

        // تغییر وضعیت رزرو به "کنسل شده"
        $reservation->status = 'cancelled';
        $reservation->save();

        return response()->json(['message' => 'Reservation cancelled successfully']);
    }
}
