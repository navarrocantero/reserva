<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $path = $this->path();
        if (strpos($path, '/password')) {
            $rules = [
                'current_password' => 'required|min:6',
                'password' => 'required|min:6|confirmed',
            ];
        } elseif (strpos($path, 'profile') === 0) {
            $rules = [
                'username' => $this->validateUserName(),
                'name' => $this->validateLastname(),
                'lastname' => $this->validateName(),
                'telephone' => $this->validateTelephone(),
                'website' => $this->validateWebsite(),
                'city' => $this->validateCity(),
                'email' => $this->validateEmail(),
            ];

        }
        return $rules;
    }


    public function validateUserName()
    {
        return 'nullable|alpha|min:3|max:30|unique:users';
    }

    private function validateEmail()
    {
        return 'nullable|email|max:100|unique:users';
    }

    private function validateLastname()
    {
        return 'nullable|alpha|min:3|max:30';
    }

    private function validateName()
    {
        return 'nullable|string|min:3|max:30';

    }

    private function validateTelephone()
    {
        return 'nullable|numeric|min:6|max:15';

    }

    private function validateWebsite()
    {
        return 'nullable|URL|numeric|min:6|max:30';

    }

    private function validateCity()
    {
        return 'nullable|alpha|min:3|max:30';

    }
}