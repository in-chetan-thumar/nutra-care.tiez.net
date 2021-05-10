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
        return [
            'role_id' => 'sometimes|required',
            'name' => 'required',
            'username' => 'required|min:3',
            'mobile' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
            'password_confirmation' => 'required_with:password|same:password',
        ];
    }
}
