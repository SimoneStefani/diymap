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
     * A place can be referenced by many boards.
     * 
     * @return App\Board
     */
    public function boards()
    {
        return $this->belongsToMany(Board::class, 'board_place', 'place_id', 'board_id')->withPivot('is_main','radius');
    }
}
