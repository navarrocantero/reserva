<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseImage extends Model
{
    public $timestamps = false;

    protected $fillable = ['content','house_id'];


    public function house(){
        return $this->belongsTo(House::class);
    }
}
