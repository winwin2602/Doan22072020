<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        if ($this->method() == 'PUT') {
            $role_id = $this->segment(4);
            return [ 
                'name' => 'required|max:50|unique:roles,name,'.$role_id, 
                'display_name' => 'required|unique:roles,display_name,'.$role_id,
            ];
        } else {
            return [ 
                'name' => 'required|max:50|unique:roles,name', 
                'display_name' => 'required|unique:roles,display_name',
            ];
        }
    }
    public function messages()
    {
        return [
            'name.required' => 'Please enter Name!',
            'name.max' => 'Name must not exceed 50 characters!',
            'name.unique' => 'Name already exists try another name.',
            'display_name.required' => 'Please enter display name.',
            'display_name.unique' => 'Display Name already exists try another name.',
        ];
    }
}
