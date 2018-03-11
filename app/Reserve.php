<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    public $timestamps = false;
    protected $fillable = ['entry_date', 'exit_date', 'user_id', 'house_id'];

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function houseReserves(int $id)
    {
        return Reserve::where(['house_id' => $id])->get();
    }

    /**
     * Devuelve todas las reservas de una casa
     * @param House $house
     * @return string
     */
    public static function getJsonReserve(House $house){
        return json_encode(Reserve::houseReserves($house->id));
    }
}