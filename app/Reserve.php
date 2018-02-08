<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    public $timestamps = false;
    protected $fillable = ['entry_date','exit_date', 'user_id', 'house_id'];


    public function House()
    {
        return $this->hasMany(House::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }


}
