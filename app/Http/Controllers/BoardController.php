<?php

namespace App\Http\Controllers;

use App\User;
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

        return redirect('boards');
    }

    public function show(string $board)
    {
        $board = Board::where('id', $board)->with('owner', 'participants')->firstOrFail();

        if (Auth::user()->id != $board->owner_id && Auth::user()->joined()->where('board_id', $board->id)) {
            throw new AccessDeniedHttpException("User not authorised!");
        }

        return view('board.board', compact('board'));
    }

    public function index()
    {
        $ownedBoards = Auth::user()->ownedBoards;
        $joinedBoards = Auth::user()->joinedBoards;

        return view('board.index', compact(['ownedBoards', 'joinedBoards']));
    }

    public function createNew() {
        return view('board.create');
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

        $user = User::where('email', $request->email)->firstOrFail();

        $board->participants()->attach($user);

        return json_encode($user);
    }

    public function updateBoard(string $board)
    {
        $board = Board::where('id', $board)->with('participants.locations')->firstOrFail();

        return json_encode($board);
    }
}
