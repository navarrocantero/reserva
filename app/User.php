<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function image()
    {
        return $this->hasOne(UserImage::class);
    }

    public function login()
    {
        return $this->hasMany(Login::class);
    }

    public function isMe(User $user)
    {
        return $this->slugname === $user->slugname;
    }

    public function houses()
    {

        return $this->hasMany(House::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
