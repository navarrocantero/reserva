<?php

namespace App\Http\Requests;

use App\Http\Requests\UserFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use \Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class UpdateHouseRequest extends CreateHouseRequest
{

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

        $rules['name'] = $this->nullable($this->validateName());
        $rules['location'] = $this->nullable($this->validateLocation());
        $rules['direction'] = $this->nullable($this->validateDirection());
        $rules['price_user_night'] = $this->nullable($this->validatePriceUserNight());
        $rules['max_users_house'] = $this->nullable($this->validateMaxUsersHouse());
        $rules['description'] = $this->nullable($this->validateDescription());
        $rules['features'] =$this->nullable($this->validateFeatures());

        return $rules;

    }


    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $response = new JsonResponse([
             $errors ,

        ]);

//        throw new ValidationException($validator, $response);
    }

    private function nullable(String $string)
    {

        $result = (str_replace('required|','nullable|',$string));
        return $result;
    }


}
