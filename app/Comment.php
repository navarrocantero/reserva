<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\House;

class Comment extends Model
{

    protected $table = "house_comments";
    protected $fillable = ['content'];

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function house()
    {
        return $this->hasOne('App\House');
    }
}
