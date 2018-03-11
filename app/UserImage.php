<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
    public $timestamps = false;

    protected $fillable = ['image_id','image_url','user_id'];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
