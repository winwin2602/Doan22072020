<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use app\Models\User;
use Illuminate\Database\Eloquent\Model;
class UserRequest extends FormRequest
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
            $user_id = $this->segment(4);
            return [ 
                'name' => 'required|max:50|unique:users,name,'.$user_id, 
                'email' => 'required|max:150|email|unique:users,email,'.$user_id,
            ];
        } else {
            return [ 
                'name' => 'required|max:50|unique:users,name', 
                'email' => 'required|max:150|email|unique:users,email',
                'password' => 'required|min:6|confirmed'
            ];
        }
        
    }
    public function messages()
    {
        return [
            'name.required' => 'Please enter Name!',
            'name.max' => 'Name must not exceed 50 characters!',
            'name.unique' => 'Name already exists try another name.',
            'email.required' => 'Please enter Email!',
            'email.max' => 'Email must not exceed 150 characters!',
            'email.email' =>'Email invalid!',
            'email.unique' => 'Email already exists try another email.',
            'password.required' => 'Please enter Password!',
            'password.min' => 'Password must be at least 6 characters!',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
