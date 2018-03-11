<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['slugname'];

    public function houses()
    {
        return $this->belongsToMany(House::class);
    }
}
