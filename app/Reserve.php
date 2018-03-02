<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    public $timestamps = false;
    protected $fillable = ['entry_date', 'exit_date', 'user_id', 'house_id'];

    public function house()
    {
        return $this->hasMany(House::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function houseReserves(int $id)
    {
        return Reserve::where(['house_id' => $id])->get();
    }
}