<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Origin;
use Illuminate\Http\Request;

class OriginController extends Controller
{
    public function index()
    {
        $origins = Origin::all();
        return response()->json($origins);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $origin = Origin::create($request->all());
        return response()->json($origin, 201);
    }

    public function update(Request $request, $id)
    {
        $origin = Origin::findOrFail($id);
        $origin->update($request->all());
        return response()->json($origin);
    }

    public function destroy($id)
    {
        $origin = Origin::findOrFail($id);
        $origin->delete();
        return response()->json(['message' => 'Origin deleted successfully']);
    }
}
