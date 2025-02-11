<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::all();
        return response()->json($destinations);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'origin_city_code' => 'required|string',
        ]);

        $destination = Destination::create($request->all());
        return response()->json($destination, 201);
    }

    public function update(Request $request, $id)
    {
        $destination = Destination::findOrFail($id);
        $destination->update($request->all());
        return response()->json($destination);
    }

    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);
        $destination->delete();
        return response()->json(['message' => 'Destination deleted successfully']);
    }
}
