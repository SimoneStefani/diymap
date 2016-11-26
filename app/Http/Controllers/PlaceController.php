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

        $place = PlaceController::insertNewPlace( $request->lati, $request->long, $request->name);

        PlaceController::attachPlaceToBoard($board, $place, $request->is_main, $request->radius);

        return json_encode($place);
    }

    public static function insertNewPlace(float $lati, float $long, string $name) 
    {
        $place = Place::where([
                ['lati', $lati],
                ['long', $long]
            ])->first();

        if (is_null($place)) {
            $place = new Place([
                'name' => $name,
                'long' => $long,
                'lati' => $lati
            ]);

            $place->save();
        }

        return $place;
    }

    public static function attachPlaceToBoard(string $boardId, Place $place, bool $isMain, float $radius) 
    {
        $board = Board::where('id', $boardId)->firstOrFail();
        $board->places()->attach($place, ['is_main' => $isMain, 'radius' => $radius]);
    }
}
