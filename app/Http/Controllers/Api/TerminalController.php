<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Terminal;
use Illuminate\Http\Request;

class TerminalController extends Controller
{
   public function index()
    {
        $terminals = Terminal::all();
        return response()->json($terminals);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'city_code' => 'required|string',
        ]);

        $terminal = Terminal::create($request->all());
        return response()->json($terminal, 201);
    }

    public function update(Request $request, $id)
    {
        $terminal = Terminal::findOrFail($id);
        $terminal->update($request->all());
        return response()->json($terminal);
    }

    public function destroy($id)
    {
        $terminal = Terminal::findOrFail($id);
        $terminal->delete();
        return response()->json(['message' => 'Terminal deleted successfully']);
    }

    public function getTerminalsByCityCode(Request $request)
    {

        $request->validate([
            'origin' => 'required|string',
        ]);

        $terminals = Terminal::where('terminal_code', $request->origin)->get();

        $result = $terminals->map(function($terminal) {
            return [
                'city_code' => $terminal->origin->city_code,
                'terminal_code' => $terminal->terminal_code,
            ];
        });

        return response()->json($result);
    }

}
