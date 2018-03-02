<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\House;

/**
 * @property mixed $house
 * @property mixed $user
 */
class Comment extends Model
{

    protected $table = "comments";
    protected $fillable = ['comment','user_id','house_id'];

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function house ()
    {
        return $this->hasOne('App\House');
    }
}
