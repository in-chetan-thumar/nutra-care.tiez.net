<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'username' => 'required|max:50|unique:users,username',
			'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|digits:10',
			'password' => 'required|min:6',
            'confirm_password' => [
                                    Rule::requiredIf(function () {
                                        return request()->get('password', '') != '';
                                    }),
                                    'same:password'],
        ];
    }

    public function messages()
    {
        return [
            'mobile' => 'mobile number',
            'mobile.digits' => 'Invalid mobile number',
            'username.unique' => 'This username has already been registered. Please proceed to the login page.'
        ];
    }

}
