<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
            'title' => 'required|max:50',
            'description' => 'required',
            'status' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'title.required' => 'we need title',
            'description.required' => 'We need description also',
            'status.required'=>'we need status also'
        ];
    }
}
