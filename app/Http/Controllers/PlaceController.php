<?php

namespace App\Http\Controllers;

use App\Board;
use App\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function store(string $board, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'long' => 'required',
            'lati' => 'required',
            'is_main' => 'required|boolean',
            'radius' => 'required|numeric'
        ]);

        // TO FIX
        $place = Place::where('lati', $request->lati)->first();

        if (is_null($place)) {
            $place = new Place([
                'name' => $request->name,
                'long' => $request->long,
                'lati' => $request->lati
            ]);

            $place->save();
        }

        $board = Board::where('id', $board)->firstOrFail();
        $board->places()->attach($place, ['is_main' => $request->is_main, 'radius' => $request->radius]);

        return json_encode($place);
    }
}
