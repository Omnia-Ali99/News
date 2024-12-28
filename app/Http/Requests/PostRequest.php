<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $rules = [
            'title'=>['required','string','min:3','max:50'],
            'desc'=>['required','min:10'],
            'small_desc'=>['required' , 'min:3' , 'max:170'],
            'category_id'=>['exists:categories,id'],
            'comment_able'=>['in:on,off,1,0'],
            'images.*' =>['image','mimes:jpeg,png,jpg,gif'],
            'status'=>['in:1,0'],
        ];

        if(in_array($this->method() , ['PUT' , 'PATCH'])){
            $rules['images']              =['nullable' , 'array' ];
        }else{
            $rules['images'] = ['required','array'];
        }
        return $rules;
    }
}
