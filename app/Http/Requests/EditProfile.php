<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EditProfile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @param Request $request
     * @return bool
     */
    public function authorize(Request $request)
    {
        if($request->user()->is_profile_completed)
            return true;

        return false;
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
            'phone_number' => 'required|string|min:10|max:20',
            'gender' => 'required|in:M,F,O',
            'dob' => 'required|date',
            'photo' => 'image|max:2000|nullable',
            'pancard' => 'nullable|alpha_num|size:10',
            'state' => [
                'required',
                Rule::in(array_keys(getIndianStates())),
            ],
            'city' => 'required|max:250|string',
            'pincode' => 'required|numeric|min:100000|max:999999',
            'district' => 'required|max:250|string',

            'bank_account_number' => 'required_without_all:paytm_number,upi_id|string|nullable|min:4|max:50',
            'bank_account_holdername' => 'required_with:bank_account_number|string|nullable|max:250',
            'bank_account_bankname' => 'required_with:bank_account_number|string|nullable|max:250',
            'bank_account_ifsc' => 'required_with:bank_account_number|string|nullable|max:50',
            'bank_account_type' => [
                'required_with:bank_account_number',
                Rule::in(['SA','CA','RDA','FDA','DTA','NRA']),
                'nullable'
            ],

            'paytm_number' => 'required_without_all:bank_account_number,upi_id|string|nullable|min:10|max:20',
            'upi_id' => 'required_without_all:paytm_number,bank_account_number|string|nullable|max:255',

            'preferred_payment_method' => [
                'required',
                Rule::in(['BANK','PAYTM','UPI']),
            ],
        ];
    }
}
