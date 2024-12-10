<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'username' => ['required', 'string', 'max:50', 'unique:admins,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email'],
            'status'=>['in:0,1'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation'=>['required'],     
        ];
    }
}
