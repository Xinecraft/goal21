<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AddNewMember extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @param Request $request
     * @return bool
     */
    public function authorize(Request $request)
    {
        if(!$request->user()->isAdmin())
            return false;

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
            'full_name' => 'required|string|max:30',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|min:10|max:20',
            'gender' => 'required|in:M,F,O',
            'dob' => 'required|date',
            'referral_user' => 'nullable|max:255|string|exists:users,username',
        ];
    }
}
