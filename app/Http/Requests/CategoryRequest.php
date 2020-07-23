<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                'name' =>   'required|max:100|min:1|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\=\;\:\?\>\<\,]/',
            ];
        }else{
            return [
                'name' =>   'required|max:100|min:1|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\=\;\:\?\>\<\,]/',
            ];
        } 
    }
    public function messages()
    {
        return [
            'name.required' => 'Please enter Name.',
            'name.max' => 'Maximum Name length is 100 characters.',
            'name.min' => 'Minimum Name length is 1 characters.',
            'name.not_regex' => 'Name cannot enter special characters.',
        ];
    }
}
