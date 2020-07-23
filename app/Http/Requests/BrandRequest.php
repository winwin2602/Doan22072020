<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        if ($this->method()=='PUT'){
             $brand_id = $this->segment(4);
            return [
                'name'      => 'required|max:100|unique:brands,name,'.$brand_id,
                'address'   => 'required|max:100|min:10',
                'phone_no'  => 'required|regex:/^[0][0-9]*$/|size:10',
                'logo'      => 'mimes:jpeg,jpg,png',
            ];
        }else{
            return [
                'name'      => 'required|max:100|unique:brands,name', 
                'address'   => 'required|max:100|min:10',
                'phone_no'  => 'required|regex:/^[0][0-9]*$/|size:10',
                'logo'      => 'required|mimes:jpeg,jpg,png',
            ];
        } 
    }
    public function messages()
    {
        return [
            'name.required' => 'Please enter Name.',
            'name.max' => 'Maximum Name length is 100 characters.',
            'name.unique' => 'Name already exists try another name.',
            'address.required' => 'Please enter Address.',
            'address.max' => 'Maximum Address length is 100 characters.',
            'address.min' => 'Minimum Address length is 10 characters.',
            'phone_no.required' => 'Please enter Phone.',
            'phone_no.regex' =>'Phone Number Invalid.',
            'phone_no.size' => 'Phone number must be 10 digits',             
            'logo.required' => 'Please choose Logo.',    
            'logo.mimes' => 'Image must be a photo (jpeg, png, jpg).', 
        ];
    }
}
