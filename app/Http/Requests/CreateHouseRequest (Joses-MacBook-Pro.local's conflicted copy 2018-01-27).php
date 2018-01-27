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
        return [
            'name' => [
                'required',
                'min:3',
                'alpha'
            ],
            'location' => [
                'required',
                'min:5',
                'unique'
            ],
            'direction' => [
                'required',
                'min:5',
                'unique'
            ],
            'price_user_night' => [
                'required',
                'numeric',
            ],
            'images' => [
                'required'
            ],
            'max_users_house' => [
                'numeric',
                'required'
            ],
            'features' => [
                'required',
            ],
            'activities' => [
                'required',
            ],
            'description' => [
                'required'
            ]
        ];
    }

    public function messages()
    {
        $REPEATED_FIELD_CONTACT_US = "El campo introducido es incorrecto, si cree que puede tratarse de un
        error pongase en contacto con nosotros";
        $EMPTY_FIELD = "El campo no puede estar vacio";
        $FIELD_LENGHT_5 = "La logitud minima es 3";
        $ALPHA = "Solo caracteres alfabeticos";
        $NUMERIC = "Solo caracteres numericos";
        $REQUIRED = "El campo es requerido";

        return [
            'name.required' => $REQUIRED,
            'name.min' => 'La longitud minima es 3',
            'name.alpha' => $ALPHA,

            'location.unique' => $REPEATED_FIELD_CONTACT_US,
            'location.min' => $FIELD_LENGHT_5,
            'location.required' => $EMPTY_FIELD,

            'direction.unique' => $REPEATED_FIELD_CONTACT_US,
            'direction.min' => $FIELD_LENGHT_5,
            'direction.required' => $EMPTY_FIELD,

            'price_user_night.required' => $EMPTY_FIELD,
            'price_user_night.numeric' => $NUMERIC,

            'images.required' => $EMPTY_FIELD,

            'max_users_house.required' => $REQUIRED,
            'max_users_house.numeric' => $NUMERIC,

            'features.required' => $REQUIRED,
            'activities.required' => $REQUIRED,
            'description.required' => $REQUIRED
        ];
    }


}
