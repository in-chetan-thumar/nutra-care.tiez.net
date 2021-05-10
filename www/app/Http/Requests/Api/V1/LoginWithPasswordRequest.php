<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class LoginWithPasswordRequest extends FormRequest
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
            'username' => 'required',
            'password' => 'required',

            //'grant_type' => 'required',
            //'scope' => 'required',
            //'client_id' => 'required',
            //'client_secret' => 'required',

            'device_token' => 'nullable',
            'device_platform' => 'nullable',
            'device_version' => 'nullable',
            'device_model' => 'nullable',
        ];
    }


}
