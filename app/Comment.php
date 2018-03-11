<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo(User::class);
    }

    public function house ()
    {
        return $this->belongsTo(House::class);
    }
}
