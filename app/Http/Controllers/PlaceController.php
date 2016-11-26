<?php

namespace App\Http\Controllers;

use App\Board;
use App\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function create(string $board)
    {
        $board = Board::where('id', $board)->firstOrFail();

        return view('board.create', compact('board'));
    }


    public function store(string $board, Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required|string',
        //     'long' => 'required',
        //     'lati' => 'required',
        //     'is_main' => 'required|boolean',
        //     'radius' => 'required|numeric'
        // ]);
        // TO FIX
        
        $board = Board::where('id', $board)->firstOrFail();
        $board->places()->create([
                'name' => $request->name,
                'long' => $request->long,
                'lati' => $request->lati,
                // 'radius' => 10
            ]);
        return redirect('/boards');
    }
}
