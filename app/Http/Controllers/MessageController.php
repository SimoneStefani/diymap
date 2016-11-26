<?php

namespace App\Http\Controllers;

use App\Board;
use App\Message;
use Illuminate\Http\Request;
use App\Events\MessageCreated;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(string $board, Request $request)
    {
        $message = new Message(['content' => $request->content]);
        $board = Board::where('id', $board)->messages()->save($message);
        Auth::user()->messages()->save($message);

        event(new MessageCreated($message));

        return $message
    }
}
