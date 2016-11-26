<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content'];

    /**
     * A message must have an author.
     * 
     * @return App\User
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A message must be sent in a board.
     * 
     * @return App\Board
     */
    public function board()
    {
        return $this->belongsTo(Board::class);
    }
}
