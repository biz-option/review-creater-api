<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormQuestionChangeSortOrderRequest extends FormRequest
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
            'direction' => 'required|in:up,down',
        ];
    }
    
    public function messages()
    {
        return [
            'direction.required' => 'directionを入力してください。',
            'direction.in' => 'directionは、up または down のいずれかである必要があります。',
        ];
    }
}
