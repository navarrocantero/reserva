<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseImage extends Model
{
    public $timestamps = false;

    protected $fillable = ['image_id','image_url','house_id'];


    public function house(){
        return $this->belongsTo(House::class);
    }


}
