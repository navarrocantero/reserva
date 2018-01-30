<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use RStrings\RStrings;

class CreateHouseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules['name'] = $this->validateName();
        $rules['location'] = $this->validateLocation();
        $rules['direction'] = $this->validateDirection();
        $rules['price_user_night'] = $this->validatePriceUserNight();
        $rules['images'] = $this->validateImages();
        $rules['max_users_house'] = $this->validateMaxUsersHouse();
        $rules['features'] = $this->validateFeatures();
        $rules['activities'] = $this->validateActivities();
        $rules['description'] = $this->validateDescription();

        return $rules;

    }

    public function messages()
    {
        $REPEATED_FIELD_CONTACT_US = "El campo introducido es incorrecto, si cree que puede tratarse de un
        error pongase en contacto con nosotros";
        $EMPTY_FIELD = "El campo no puede estar vacio";
        $FIELD_LENGHT_5 = "La logitud minima es 5";
        $ALPHA = "Solo caracteres alfabeticos";
        $NUMERIC = "Solo caracteres numericos";
        $REQUIRED = "El campo es requerido";

        $name = $this->messagesName();
        $location = $this->messagesLocation();
        $direction = $this->messagesDirection();
        $price_user_night = $this->messagesPriceUserNight();
        $images = $this->messagesImage();
        $max_users_house = $this->messagesMaxUsersHouse();
        $features = $this->messagesFeatures();
        $activities = $this->messagesActivities();
        $description = $this->messagesDescription();

        return array_merge($name, $location, $direction, $price_user_night,
            $images, $max_users_house, $features, $activities, $description);

    }

    protected function validateName()
    {
        return 'required|min:3|alpha';
    }

    private function validateLocation()
    {
        return 'min:5|required';
    }

    private function validateDirection()
    {
        return 'min:5|required';
    }

    private function validatePriceUserNight()
    {
        return 'numeric|required';
    }

    private function validateImages()
    {
        return 'required';
    }

    private function validateMaxUsersHouse()
    {
        return 'required|numeric|min:1';
    }

    private function validateActivities()
    {
        return 'required';
    }

    private function validateFeatures()
    {
        return 'required';
    }

    private function validateDescription()
    {
        return 'required';
    }

    private function messagesName()
    {
        $messages = array();
        $messages["name.required"] = "El nombre es requerido";
        $messages["name.min"] = 'Longitud minima de 3';
        $messages["name.alpha"] = 'Solo caracteres alfabeticos';
        return $messages;
    }

    private function messagesLocation()
    {
        $messages = array();
        $messages["location.min"] = "Longitud minima de 5";
        $messages["location.required"] = "La localizacion es obligatoria";
        return $messages;
    }

    private function messagesDirection()
    {
        $messages = array();
        $messages["direction.numeric"] = "Solo caracteres numericos";
        $messages["direction.min"] = "La longitud minima es 5";
        return $messages;
    }

    private function messagesPriceUserNight()
    {
        $messages = array();
        $messages["price_user_night.numeric"] = "Solo caracteres numericos";
        $messages["price_user_night.required"] = "La direccion es obligatoria";
        return $messages;
    }

    private function messagesImage()
    {
        $messages = array();
        $messages["images.required"] = "La imagen es obligatoria";
        return $messages;
    }

    private function messagesMaxUsersHouse()
    {
        $messages = array();
        $messages["max_users_house.required"] = "El maximo de de usuarios es obligatorio";
        $messages["max_users_house.numeric"] = "Solo caracteres numericos";
        $messages["max_users_house.min"] = "El minimo es uno";

        return $messages;
    }


    private function messagesFeatures()
    {
        $messages = array();
        $messages["features.required"] = "Las caracteristicas son  bligatorias";
        return $messages;
    }

    private function messagesActivities()
    {
        $messages = array();
        $messages["activities.required"] = "Las actividades son  bligatorias";
        return $messages;
    }

    private function messagesDescription()
    {
        $messages = array();
        $messages["description.required"] = "La descripcion es  bligatorias";
        return $messages;
    }


}
