<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WallpaperCommentRequest extends FormRequest
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
            'wallpaper_id' => 'required|exists:wallpaper,id',
			'parent_comment_id' => 'required|exists:wallpaper_comment,id',
            'comment' => 'required|max:200',
        ];
    }

}
