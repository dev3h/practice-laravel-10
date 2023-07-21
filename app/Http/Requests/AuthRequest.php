<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class AuthRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        if(Route::current()->uri == 'auth/login') 
        return [
            'email' => 'bail|required|email',
            'password' => 'bail|required'
        ];
        else if(Route::current()->uri == 'auth/register')
        return [
            'name'=> 'bail|required',
            'email' => 'bail|required|email',
            'password' => 'bail|required'
        ];
    }
    public function messages(): array {
        if(Route::current()->uri == 'auth/login') 
        return [
            'email.required' => 'vui lòng nhập email',
            'email.email' => 'định dạng email không đúng',
            'password.required' => 'vui lòng nhập password'
        ];
         else if(Route::current()->uri == 'auth/register')
           return [
            'name.required'=> 'vui lòng nhập tên',
            'email.required' => 'vui lòng nhập email',
            'email.email' => 'định dạng email không đúng',
            'password.required' => 'vui lòng nhập password'
        ];
    }
}
