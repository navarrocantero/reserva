<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function features(){
        return $this->belongsToMany(Feature::class);
    }

    public function reserves(){
        return $this->hasMany(Reserve::class);
    }

    public function images(){
        return $this->hasMany(HouseImage::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }



}
