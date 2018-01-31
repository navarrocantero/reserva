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

    public function validateName()
    {
        return 'required|min:3|alpha';
    }

    protected function validateLocation()
    {
        return 'min:5|required';
    }

    protected function validateDirection()
    {
        return 'min:5|required';
    }

    protected function validatePriceUserNight()
    {
        return 'numeric|required|min:1';
    }

    protected function validateImages()
    {
        return 'required';
    }

    protected function validateMaxUsersHouse()
    {
        return 'required|numeric|min:1';
    }

    protected function validateActivities()
    {
        return 'required';
    }

    protected function validateFeatures()
    {
        return 'required';
    }

    protected function validateDescription()
    {
        return 'required';
    }

    protected function messagesName()
    {
        $messages = array();
        $messages["name.required"] = "El nombre es requerido";
        $messages["name.min"] = 'Longitud minima de 3';
        $messages["name.alpha"] = 'Solo caracteres alfabeticos';
        return $messages;
    }

    protected function messagesLocation()
    {
        $messages = array();
        $messages["location.min"] = "Longitud minima de 5";
        $messages["location.required"] = "La localizacion es obligatoria";
        return $messages;
    }

    protected function messagesDirection()
    {
        $messages = array();
        $messages["direction.numeric"] = "Solo caracteres numericos";
        $messages["direction.min"] = "La longitud minima es 5";
        return $messages;
    }

    protected function messagesPriceUserNight()
    {
        $messages = array();
        $messages["price_user_night.min"] = 'Solo valores positivos';
        $messages["price_user_night.numeric"] = "Solo caracteres numericos";
        $messages["price_user_night.required"] = "La direccion es obligatoria";
        return $messages;
    }

    protected function messagesImage()
    {
        $messages = array();
        $messages["images.required"] = "La imagen es obligatoria";
        return $messages;
    }

    protected function messagesMaxUsersHouse()
    {
        $messages = array();
        $messages["max_users_house.required"] = "El maximo de de usuarios es obligatorio";
        $messages["max_users_house.numeric"] = "Solo caracteres numericos";
        $messages["max_users_house.min"] = "Solo valores positivos";

        return $messages;
    }

    protected function messagesFeatures()
    {
        $messages = array();
        $messages["features.required"] = "Las caracteristicas son  obligatorias";
        return $messages;
    }

    protected function messagesActivities()
    {
        $messages = array();
        $messages["activities.required"] = "Las actividades son  obligatorias";
        return $messages;
    }

    protected function messagesDescription()
    {
        $messages = array();
        $messages["description.required"] = "La descripcion es  obligatorias";
        return $messages;
    }


}
