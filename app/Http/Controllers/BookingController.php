<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use App\Models\Reservation;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function booking(Request $request)
    {
        // اعتبارسنجی ورودی‌ها
        $request->validate([
            'reserve_id' => 'required|exists:reservations,id', // رزرو باید موجود باشد
            'passengers_list' => 'required|array', // لیست مسافران باید موجود باشد
        ]);

        // پیدا کردن رزرو بر اساس reserve_id
        $reservation = Reservation::findOrFail($request->reserve_id);

        // لیست بلیط‌های جدید برای مسافران
        $tickets = [];

        // ایجاد بلیط برای هر مسافر
        foreach ($request->passengers_list as $passengerData) {
            // استفاده از firstOrCreate برای جلوگیری از تکراری بودن کد ملی
            $passenger = Passenger::firstOrCreate(
                ['identity_id' => $passengerData['identity_id']], // شرط برای پیدا کردن مسافر
                [
                    'first_name' => $passengerData['first_name'],
                    'last_name' => $passengerData['last_name'],
                    'phone_number' => $passengerData['phone_number'],
                ]
            );

            // ایجاد بلیط
            $ticket = Ticket::create([
                'reservation_id' => $reservation->id,
                'passenger_id' => $passenger->id,
                'ticket_number' => strtoupper(uniqid('TICKET-')), // شماره بلیط منحصر به فرد
                'identity_id' => $passenger->identity_id,
                'trip_id' => $reservation->trip_id,
            ]);

            $tickets[] = $ticket; // اضافه کردن بلیط به آرایه
        }

        return response()->json([
            'message' => 'Tickets booked successfully',
            'tickets' => $tickets,
        ]);
    }


public  function refund($ticket_id)
{
    // پیدا کردن بلیط با شناسه ورودی
    $ticket = Ticket::find($ticket_id);

    // بررسی اینکه آیا بلیط وجود دارد
    if (!$ticket) {
        return response()->json(['error' => 'Ticket not found'], 404);
    }

    // بررسی اینکه بلیط در وضعیت قابل استرداد است
    // فرض می‌کنیم که اگر بلیط بیش از 24 ساعت قبل خریداری شده باشد، قابل استرداد نیست
    if (Carbon::now()->diffInHours($ticket->created_at) > 24) {
        return response()->json(['error' => 'Ticket cannot be refunded. It is past the refund window.'], 400);
    }

    // تغییر وضعیت بلیط به کنسل
    $ticket->status = 'cancelled'; // یا می‌توانید آن را حذف کنید با $ticket->delete();
    $ticket->cancellation_date = Carbon::now();
    $ticket->save();

    // بازگشت پیام موفقیت
    return response()->json(['message' => 'Ticket refunded successfully.'], 200);
}
}
