<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'lati', 'long'];

    /**
     * A place can be referenced by a board.
     * 
     * @return App\Board
     */
    public function boards()
    {
        return $this->belongsTo(Board::class);
    }
}
