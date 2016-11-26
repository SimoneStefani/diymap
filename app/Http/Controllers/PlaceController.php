<?php

namespace App\Http\Controllers;

use App\Board;
use App\Place;
use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\Factory;

class PlaceController extends Controller
{
    public function create(string $board)
    {
        $board = Board::where('id', $board)->firstOrFail();

        return view('board.create', compact('board'));
    }


    public function store(string $board, Request $request)
    {        
        $board = Board::where('id', $board)->firstOrFail();
        $place = factory(Place::class)->make();
        $board->places()->save($place);
        return redirect('/boards');
    }
}
