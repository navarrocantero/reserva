<?php

namespace App\Http\Requests;

use App\Http\Requests\UserFormRequest;
use \Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class CreateHouseAjaxRequest extends CreateHouseRequest
{

    public function rules()
    {

        $rules = array();

        if($this->exists('name')){
            $rules['name'] = $this->validateName();
        }

        return $rules;
    }


    protected function failedValidation($validator)
    {

        $errors = $validator->errors();
        $response = new JsonResponse([
            'name' => $errors->get('name'),
        ]);

        throw new ValidationException($validator, $response);
    }

}
