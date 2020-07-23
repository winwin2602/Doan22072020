<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            $id = $this->segment(4);
            return [
                'name' => 'required|max:255|min:5|unique:products,name,'.$id,
                'url_image' => 'mimes:jpeg,jpg,png',
                'price' => 'required|min:1|regex:/^[1-9][0-9.]*$/',
                'promotion_price' => 'nullable|regex:/^[1-9][0-9.]*$/',
                'quantity' => 'required|min:1|regex:/^[1-9][0-9]*$/',
                'brand_id' => 'required',
                'category_id' => 'required',
            ];
        }else{
            return [
                'name' => 'required|max:255|min:5|unique:products,name',
                'url_image' => 'mimes:jpeg,jpg,png',
                'price' => 'required|min:1|regex:/^[1-9][0-9.]*$/',
                'promotion_price' => 'nullable|regex:/^[1-9][0-9.]*$/',
                'quantity' => 'required|min:1|regex:/^[1-9][0-9]*$/',
                'brand_id' => 'required',
                'category_id' => 'required',
            ];
        } 
    }
    public function messages()
    {
        return [
            'name.required' => 'Please enter Name.',
            'name.max' => 'Maximum Name length is 255 characters.',
            'name.min' => 'Minimum Name length is 5 characters.',
            'name.unique' => 'Name already exists try another name.',
            'url_image.mimes' => 'Image must be a photo (jpeg, png, jpg).',
            'price.required' => 'Please enter Price.',
            'price.min' => 'Price invalid.',
            'price.regex' => 'Prices must not enter the first zero.',
            'promotion_price.regex' => 'Promotion Price Invalid.',
            'quantity.required' => 'Please enter Quantity.',
            'quantity.min' => 'Quantity invalid.',
            'quantity.regex' => 'Quantity must not enter the first zero.',
            'brand_id.required' => 'Please choose Brand.',
            'category_id.required' => 'Please choose Category.',
        ];
    }
}
