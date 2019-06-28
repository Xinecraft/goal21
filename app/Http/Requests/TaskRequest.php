<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'type' => 'required|in:0,1,2',
            'link' => 'required|url',
            'wait_in_seconds' => 'required|numeric',
            'is_active' => 'required|boolean',
            'credit_inr' => 'required|numeric|max:1000'
        ];
    }
}
