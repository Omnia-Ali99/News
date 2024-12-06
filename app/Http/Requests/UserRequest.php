<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' =>['required', 'string', 'max:50', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone'=>['required','max:16', 'unique:users,phone'],
            'status'=>['in:0,1'],
            'email_verified_at'=>['in:0,1'],
            'country'=>['required', 'string', 'max:50'],
            'city'=>['required', 'string', 'max:50'],
            'street'=>['required','string', 'max:50'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation'=>['required'],      
        ];
    }
}
