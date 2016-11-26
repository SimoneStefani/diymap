<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * A user may have created many boards.
     * 
     * @return App\Board
     */
    public function ownedBoards()
    {
        return $this->hasMany(Board::class, 'owner_id');
    }

    /**
     * A user may join many boards.
     * 
     * @return App\Board
     */
    public function joinedBoards()
    {
        return $this->belongsToMany(Board::class, 'board_user', 'user_id', 'board_id')
    }

    /**
     * A user may be invited to many boards.
     * 
     * @return App\Board
     */
    public function invitedBoards()
    {
        return $this->belongsToMany(Board::class, 'board_user_invitation', 'user_id', 'board_id')
    }

    /**
     * A user may have many locations.
     * 
     * @return App\Location
     */
    public function locations()
    {
        return $this->belongsToMany(Location::class, 'location_user', 'location_id', 'user_id')
    }
}
