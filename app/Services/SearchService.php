<?php

namespace App\Services;

use App\Models\Search;
use App\Models\Trip;

class SearchService
{
    public function performSearch($validated)
    {
        // جستجو در مدل Trip بر اساس فیلدهای دریافت‌شده
        $trips = Trip::search(
            $validated['origin_city_code'] ?? null,
            $validated['origin_terminal_code'] ?? null,
            $validated['origin_name'] ?? null,
            $validated['destination_city_code'] ?? null,
            $validated['destination_terminal_code'] ?? null,
            $validated['destination_name'] ?? null,
            $validated['date'] ?? null,
            $validated['transport_type'] ?? null,
            $validated['origin_terminal_code'] ?? null,
            $validated['destination_terminal_code'] ?? null,
        )->get();

        // ذخیره نتایج جستجو در مدل Search
        foreach ($trips as $trip) {
            Search::create([
                'origin_city_code' => $validated['origin_city_code'],
                'origin_terminal_code' => $validated['origin_terminal_code'],
                'origin_name' => $validated['origin_name'],
                'destination_city_code' => $validated['destination_city_code'],
                'destination_terminal_code' => $validated['destination_terminal_code'],
                'destination_name' => $validated['destination_name'],
                'date' => $validated['date'],
                'transport_type_id' => $validated['transport_type'],
                'trip_id' => $trip->id,
                'seat_count' => $trip->seat_count,
            ]);
        }

        return $trips;
    }
}
