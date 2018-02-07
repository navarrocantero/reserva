<?php

namespace App\Http\Requests;

use App\Http\Requests\UserFormRequest;
use Illuminate\Http\Request;
use \Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class CreateCommentAjaxRequest extends CreateCommentRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        switch ($_POST['type']) {

            case 'comment':
                $rules['comment'] = $this->validateAddComment();
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
