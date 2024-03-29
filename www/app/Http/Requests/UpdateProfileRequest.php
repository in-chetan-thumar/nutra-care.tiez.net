<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        $user = \Auth::user();
        return [
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$user->id.'|min:3',
            'mobile' => 'required|numeric|digits:10|unique:users,mobile,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes() {
        return [
            //
        ];
    }
}
