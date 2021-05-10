<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
                //'category' => 'required',
                'title' => 'required',
                'description_edit' => 'required',
                'news_doc' => 'nullable|mimes:jpeg,jpg,png,gif|max:1024',
                'cover_type' => 'required',
                'cover_video_url' => 'nullable|url',
            ];
        }else{
            return [
                //'category' => 'required',
                'title' => 'required',
                'description' => 'required',
                'news_doc' => 'nullable|mimes:jpeg,jpg,png,gif|max:1024',
                'cover_type' => 'required',
                'cover_video_url' => 'nullable|url',
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
            'news_category_id' => 'news category'
        ];
    }
}
