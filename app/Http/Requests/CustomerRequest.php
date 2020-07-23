<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'full_name'=> 'required|max:100',
                'address'=> 'required|max:100|min:10',
                'phone_no'  => 'required|regex:/^[0][0-9]*$/|size:10',
                 'email' => 'required|max:150',
                   'slug'=> 'required'
        ];
    }
    public function messages()
    {
        return [
            'full_name.required' => 'Please enter Name.',
            'full_name.max' => 'Maximum Name length is 100 characters.',
            'address.required' => 'Please enter Address.',
            'address.max' => 'Maximum Address length is 100 characters.',
            'address.min' => 'Minimum Address length is 10 characters.',
            'phone_no.required' => 'Please enter Phone.',
            'phone_no.regex' =>'Phone Number Invalid.',
            'phone_no.size' => 'Phone number must be 10 digits',
             'email.required' => 'Please enter Email!',
            'email.max' => 'Email must not exceed 150 characters!',   
             'slug.required' => 'Please enters slug'
        ];
    }
}
