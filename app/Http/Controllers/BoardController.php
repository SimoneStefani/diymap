<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class BoardController extends Controller
{
    public function store(Request $request)
    {
        // If fails, throws 422
        $this->validate($request, [
            'title' => 'required|string'
        ]);

        $newBoard = Auth::user()->ownedBoards()->create([
            'title' => $request->title
        ]);

        return json_encode($newBoard);
    }

    public function destroy(string $board)
    {
        // If fails, throws 404
        $board = Board::where('id', $board)->firstOrFail();
        
        // If fails, throws 403
        if (! Auth::check() || ! Auth::user()->id == $board->owner_id) {
            throw new AccessDeniedHttpException("User not authorised!");
        }

        // If fails, throws 500
        $board->delete();

        return json_encode($board);
    }

    public function addUser(string $board, Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        $board = Board::where('id', $board)->firstOrFail();

        $user = User::where('email', $request->email)->fristOrFail();

        $board->participants()->attach($user);

        return json_decode($user);
    }
}
