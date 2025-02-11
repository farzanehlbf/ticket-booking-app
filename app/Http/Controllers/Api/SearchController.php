<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {

        $request->validate([
            'origin' => 'required|string',
            'destination' => 'required|string',
            'date' => 'required|date_format:U',
        ]);


        $trips = Trip::with(['origin', 'destination', 'terminal'])
            ->whereHas('origin', function ($query) use ($request) {
                $query->where('city_code', $request->origin);
            })
            ->whereHas('destination', function ($query) use ($request) {
                $query->where('city_code', $request->destination);
            })
            ->where('date', '>=', \Carbon\Carbon::createFromTimestamp($request->date)->toDateTimeString())
            ->get();



        return response()->json($trips);
    }
}
