<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
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
        $rules['comment'] = $this->validateAddComment();
        return $rules;
    }

    public function messages()
    {
        $addComment = $this->messagesAddComment();

        return array_merge($addComment);
    }


    protected function validateAddComment()
    {
        return 'min:50|required';

    }

    protected function messagesAddComment()
    {
        $messages = array();
        $messages["comment.min"] = "Longitud minima de 50";
        $messages["comment.required"] = "El comentario es obligatorio";
        return $messages;
    }
}
