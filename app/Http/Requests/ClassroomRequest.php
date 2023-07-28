<?php

namespace App\Http\Requests;

use App\Rules\UpperCase;
use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    protected $stopOnFirstFailure = true;
    // protected $redirect = '/classroom';
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
            'name' => ['required', 'min:2', new UpperCase],
            // 'test' => 'min:2',
        ];

    }
    public function messages(): array
    {
        return [
            'name.required' => 'Bắt buộc nhập tên lớp học',
        ];
    }
    // protected function prepareForValidation():void {
    //     $this->merge([
    //         'name' => 'Hi'
    //     ]);
    // }

    // protected function passedValidation(): void {
    //     $this->replace(['name'=> 'F1']);
    // }
}
