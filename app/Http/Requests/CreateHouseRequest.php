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
        $rules['max_users_house'] = $this->validateMaxUsersHouse();
        $rules['features'] = $this->validateFeatures();
        $rules['activities'] = $this->validateActivities();
        $rules['description'] = $this->validateDescription();

        return $rules;

    }

    public function messages()
    {


        $name = $this->messagesName();
        $location = $this->messagesLocation();
        $direction = $this->messagesDirection();
        $price_user_night = $this->messagesPriceUserNight();
        $max_users_house = $this->messagesMaxUsersHouse();
        $features = $this->messagesFeatures();
        $activities = $this->messagesActivities();
        $description = $this->messagesDescription();

        return array_merge($name, $location, $direction, $price_user_night,
            $max_users_house, $features, $activities, $description);

    }

    public function validateName()
    {
        return 'required|min:3|alpha|max:100';
    }

    protected function validateLocation()
    {
        return 'min:5|required|max:100';
    }

    protected function validateDirection()
    {
        return 'min:5|required|max:100';
    }

    protected function validatePriceUserNight()
    {
        return 'numeric|required|min:1|max:1000';
    }

    protected function validateMaxUsersHouse()
    {
        return 'required|numeric|min:1|max:10';
    }

    protected function validateActivities()
    {
        return 'required|min:50|max:300';
    }

    protected function validateFeatures()
    {
        return 'required|min:50|max:300';
    }

    protected function validateDescription()
    {
        return 'required|min:50|max:300';
    }

    protected function messagesName()
    {
        $messages = array();
        $messages["name.required"] = "El nombre es requerido";
        $messages["name.min"] = 'Longitud minima de 3';
        $messages["name.max"] = 'Longitud minima de 100';
        $messages["name.alpha"] = 'Solo caracteres alfabeticos';
        return $messages;
    }

    protected function messagesLocation()
    {
        $messages = array();
        $messages["location.min"] = "Longitud minima de 5";
        $messages["location.max"] = "Longitud maxima de 100";
        $messages["location.required"] = "La localizacion es obligatoria";
        return $messages;
    }

    protected function messagesDirection()
    {
        $messages = array();
        $messages["direction.numeric"] = "Solo caracteres numericos";
        $messages["direction.required"] = "La direccion es obligatoria";
        $messages["direction.max"] = "Longitud maxima de 100";
        $messages["direction.min"] = "Longitud minima de 5";
        return $messages;
    }

    protected function messagesPriceUserNight()
    {
        $messages = array();
        $messages["price_user_night.min"] = 'El minimo es 1';
        $messages["price_user_night.max"] = 'El maximo es 1000';
        $messages["price_user_night.numeric"] = "Solo caracteres numericos";
        $messages["price_user_night.required"] = "La direccion es obligatoria";
        return $messages;
    }



    protected function messagesMaxUsersHouse()
    {
        $messages = array();
        $messages["max_users_house.required"] = "El maximo de de usuarios es obligatorio";
        $messages["max_users_house.numeric"] = "Solo caracteres numericos";
        $messages["max_users_house.min"] = "El minimo es 1";
        $messages["max_users_house.max"] = "El maximo es 10";

        return $messages;
    }

    protected function messagesFeatures()
    {
        $messages = array();
        $messages["features.required"] = "Las caracteristicas son  obligatorias";
        $messages["features.min"] = "Longitud minima de 50";
        $messages["features.max"] = "Longitud maxima de 300";
        return $messages;
    }

    protected function messagesActivities()
    {
        $messages = array();
        $messages["activities.required"] = "Las actividades son  obligatorias";
        $messages["activities.min"] = "Longitud minima de 50";
        $messages["activities.max"] = "Longitud maxima de 300";
        return $messages;
    }

    protected function messagesDescription()
    {
        $messages = array();
        $messages["description.required"] = "La descripcion es  obligatorias";
        $messages["description.max"] = "Longitud  maxima de 300";
        $messages["description.min"] = "Longitud minima de 50";
        return $messages;
    }


}
