<?php

namespace App\Providers;

use App\Board;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        /*
         * Authenticate the user's personal channel...
         */
        Broadcast::channel('board.*', function ($user, $boardId) {
            return $user->id === Board::where('id', $boardId)->first() || $user->joinedBoards()->where('board_id', $boardId);
        });
    }
}
