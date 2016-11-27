<?php

namespace App\Http\Controllers;

use App\Board;
use App\Place;
use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\Factory;

class PlaceController extends Controller
{
    public function store(string $board, Request $request)
    {        
        $board = Board::where('id', $board)->firstOrFail();

        $long = $request->input('long');
        $lati = $request->input('lati');

        $now = new \DateTime();
        $place = new Place([
            'long' => $long,
            'lati' => $lati,
            'created_at' => $now,
            'updated_at' => $now,
            'name' => 'Pew',
            'is_main' => true,
            'radius' => 17,
            'board_id' => $board->id
        ]);

        $place->save();
        return redirect('/boards/' . $board->id);
    }
}
