<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RegisterRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'name'      => 'required|max:50|min:3|regex:/^[a-zA-Z0-9]*$/',
            'email'     => 'required|email|max:100',
            'password'  => 'required|min:8|confirmed',
            'full_name' => 'required|max:100|min:5|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\-\/\=\+\"\:\;\<\.\>\?]/',
            'address'   => 'required|max:100|min:10|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
            'phone_no'  => 'required|regex:/^[0][0-9]*$/|size:10',
        ];
    }
    public function messages()
    {
        return [
            'name.required' =>trans('regis.name'),
            'name.max' =>trans('regis.name.max'),
            'name.min' =>trans('regis.name.min'),
            'name.regex' =>trans('regis.name.regex'),
            'email.required' =>trans('regis.email'),
            'email.email' => trans('regis.email.email'),
            'email.max' => trans('regis.email.max'),
            'password.required' =>trans('regis.password'),
            'password.min' =>trans('regis.password.min') ,
            'password.confirmed' =>'Password confirmation does not match.',
            'full_name.required' =>trans('regis.full name') ,
             'full_name.numeric' =>trans('regis.full name.numeric') ,
            'full_name.max' => trans('regis.full name.max') ,
            'full_name.min' => trans('regis.full name.min') ,
            'full_name.not_regex' => trans('regis.full name.not_regex') ,
            'address.required' =>trans('regis.address'),
            'address.max' =>trans('regis.address.max'),
            'address.min' => trans('regis.address.min'),
            'address.not_regex' => trans('regis.address.not_regex'),
            'phone_no.required' =>trans('regis.phone'),
            'phone_no.regex' => trans('regis.phone.regex'),
            'phone_no.size' =>trans('regis.phone.size'),
        ];
    }
}
