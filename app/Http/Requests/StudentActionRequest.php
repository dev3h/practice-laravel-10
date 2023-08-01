<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentActionRequest extends FormRequest
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
    public function rules(): array
    {
        $rules = ['name' => 'required|string',
            'classroom_id' => 'required|exists:classrooms,id,deleted_at,NULL',];
            if($this->photo) {
                $rules['photo'] = 'mimes:jpg,bmp,png|max:25000';
            }
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Bắt buộc nhập name',
            'name.string' => 'name phải là kiểu chuỗi',
            'classroom_id.exists' => 'lỗi không tồn tại classroom id',
            'classroom_id.required' => 'phải nhập classroom id',
            'photo.mimes' => 'ảnh phải có đuôi jpg, bmp, png',
            'photo.max' => 'ảnh tối đa dung lượng là 25000',
        ];
    }
}
