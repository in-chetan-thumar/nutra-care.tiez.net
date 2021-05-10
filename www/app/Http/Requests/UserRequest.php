<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if(isset($this->id)){
            return [
                'role_id' => 'sometimes|required',
                'name' => 'required',
                'username' => 'required|unique:users,username,'.$this->id.'|min:3',
                'mobile' => 'required|numeric|digits:10|unique:users,mobile,'.$this->id,
                'email' => 'required|email|unique:users,email,'.$this->id,
                'password' => 'nullable|min:6',
                'password_confirmation' => 'required_with:password|same:password',
            ];
        }else{
            return [
                'role_id' => 'required',
                'name' => 'required',
                'username' => 'required|unique:users,username|min:3',
                'mobile' => 'required|numeric|digits:10|unique:users,mobile',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password',
            ];
        }
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes() {
        return [
            'role_id' => 'role'
        ];
    }
}
