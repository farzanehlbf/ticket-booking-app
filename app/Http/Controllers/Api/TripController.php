<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{

    public function index()
    {
        $trips = Trip::with(['origin', 'destination', 'terminal'])->get();
        return response()->json($trips);
    }

    // نمایش یک سفر خاص
    public function show($id)
    {
        $trip = Trip::with(['origin', 'destination', 'terminal'])->findOrFail($id);
        return response()->json($trip);
    }

    // ایجاد سفر جدید
    public function store(Request $request)
    {
        $request->validate([
            'origin_id' => 'required|exists:origins,id',
            'destination_id' => 'required|exists:destinations,id',
            'terminal_id' => 'required|exists:terminals,id',
            'transport_type_id' => 'required|exists:transport_types,id',
            'date' => 'required|date',
        ]);

        $trip = Trip::create($request->all());

        return response()->json($trip, 201);
    }

    // بروزرسانی سفر
    public function update(Request $request, $id)
    {
        $trip = Trip::findOrFail($id);

        $request->validate([
            'origin_id' => 'required|exists:origins,id',
            'destination_id' => 'required|exists:destinations,id',
            'terminal_id' => 'required|exists:terminals,id',
            'transport_type_id' => 'required|exists:transport_types,id',
            'date' => 'required|date',
        ]);

        $trip->update($request->all());

        return response()->json($trip);
    }

    // حذف سفر
    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);
        $trip->delete();

        return response()->json(['message' => 'Trip deleted successfully']);
    }
}
