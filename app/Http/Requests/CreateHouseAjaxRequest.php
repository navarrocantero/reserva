<?php

namespace App\Http\Requests;

use App\Http\Requests\UserFormRequest;
use Illuminate\Http\Request;
use \Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class CreateHouseAjaxRequest extends CreateHouseRequest
{


    public function rules()
    {
        $rules = [];

        switch ($_POST['type']) {

            case 'name':
                $rules['name'] = $this->validateName();
                return $rules;

            case 'location':
                $rules['location'] = $this->validateLocation();
                return $rules;

            case 'direction':
                $rules['direction'] = $this->validateDirection();
                return $rules;

            case 'images':
                $rules['images'] = $this->validateImages();
                return $rules;

            case 'price_user_night':
                $rules['price_user_night'] = $this->validatePriceUserNight();
                return $rules;

            case 'max_users_house':
                $rules['max_users_house'] = $this->validateMaxUsersHouse();
                return $rules;

            case 'features':
                $rules['features'] = $this->validateFeatures();
                return $rules;


            case 'description':
                $rules['description'] = $this->validateDescription();
                return $rules;
        }
    }

    protected function failedValidation($validator)
    {
        $type = $_POST['type'];

        $errors = $validator->errors();
        $response = new JsonResponse([
            $type => $errors->get($type),

        ]);

        throw new ValidationException($validator, $response);
    }

}
