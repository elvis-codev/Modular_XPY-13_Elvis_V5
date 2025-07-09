<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditStudentProfileRequest extends FormRequest
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
            'name' => 'required|max:255',
            'address' => 'nullable|max:255',
            'phone' => 'nullable|max:15',
            'gender' => 'nullable|max:10',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => trans('translate.Name is required'),
        ];
    }
}
