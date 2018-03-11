<?php

namespace App\Http\Requests;

use App\Http\Requests\UserFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use \Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class UpdateCommentRequest extends CreateCommentRequest
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

        $rules['comment'] = $this->validateAddComment();
        return $rules;

    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $response = new JsonResponse([
             $errors->get('comment'),

        ]);

        throw new ValidationException($validator, $response);
    }


}
