<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
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
            return [
                'content' => 'required|max:255|min:5',
                'image' => 'mimes:jpeg,jpg,png',
                'url' => 'required|max:255|min:1',
            ];
        }else{
            return [
                'content' => 'required|max:255|min:5',
                'image' => 'required|mimes:jpeg,jpg,png',
                'url' => 'required|max:255|min:1',
            ];
        }
    }

    public function messages()
    {
        return [
            'content.required' => 'Please enter content.',
            'content.max:255' => 'Maximum content length is 255 characters.',
            'content.min:5' => 'Minimum content length is 5 characters.',
            'image.required' => 'Please choose Image.',
            'image.mimes' => 'Image must be a photo (jpeg, png, jpg).',
            'url.required' => 'Please enter Url.',
            'url.max:255' => 'Maximum url length is 255 characters.',
            'url.min:1' => 'Minimum url length is 1 characters.',
        ];
    }
}
