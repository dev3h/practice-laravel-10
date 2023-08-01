<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        $rules = [ 'sortColumn' => 'in:name,created_by_email,updated_by_email,id,classroom_name',
        'sortType' => 'in:asc,desc',
    ];
        if($this->input('search') != null){
            $rules['search'] = 'string';
        }
        return $rules;
    }
}
