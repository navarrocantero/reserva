<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['slugname'];

    public function Houses()
    {
        return $this->belongsToMany(House::class);
    }
}
