<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class House extends Model
{
    static $NO_IMAGE_LINK = "https://vignette3.wikia.nocookie.net/lego/images/a/ac/No-Image-Basic.png";

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function reserves()
    {
        return $this->hasMany(Reserve::class);
    }

    public function images()
    {
        return $this->hasMany(HouseImage::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    /**
     * Metodo que devuelve la imagen en su formato para poder mostrarla
     * @param $image
     * @return mixed
     */
    public static function getImageExtension($image)
    {
        if (starts_with($image, ["https://", "http://"])) {
            return $image;
        }
        return Storage::disk('public')->url($image);

    }

    /**
     * Metodo que devuelve la primera imagen de una casa
     * @param House $house
     * @return mixed
     */
    public static function getFirstImage(House $house)
    {
        $image = $house->images()->first()->image_url;
        return House::getImageExtension($image);

    }


}
