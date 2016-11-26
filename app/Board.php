<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * A board is owned by a user.
     * 
     * @return App\User
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A board can be joined by many users (exclude owner).
     * 
     * @return App\User
     */
    public function participants()
    {
        return $this->belongsToMany(User::class);
    }

    public function isParticipant($email)
    {
        return $this->participants->where('email', $email)->count() > 0;
    }

    /**
     * A board may contain many messages.
     * 
     * @return App\Message
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'board_id');
    }

    /**
     * A board can contain many places.
     * 
     * @return App\Place
     */
    public function places()
    {
        return $this->hasMany(Place::class);
    }

    /**
     * A board may have many invited users.
     * 
     * @return App\user
     */
    public function invitedUsers()
    {
        return $this->belongsToMany(User::class, 'board_user_invitation', 'user_id', 'board_id');
    }
}
