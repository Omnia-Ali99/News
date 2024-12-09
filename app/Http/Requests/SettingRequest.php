<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'site_name' => ['required', 'string','min:2', 'max:60'],
            'email' => ['required','email'],
            'phone'=>['required','required'],
            'country'=>['required', 'string', 'max:50'],
            'city'=>['required', 'string', 'max:50'],
            'street'=>['required','string', 'max:70'],
            'facebook' => ['required', 'string', 'max:30'],
            'twitter' => ['required', 'string', 'max:30'],
            'instagram' => ['required', 'string', 'max:30'],
            'youtube' => ['required', 'string', 'max:30'],
            'small_desc' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
            'favicon' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],

                  ];
    }
}
