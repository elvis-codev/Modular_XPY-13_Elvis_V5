<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'name' => 'required|string|max:255|unique:schools',
                'slug' => 'nullable|string|max:255|unique:schools',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'primary_color' => 'required|string|regex:/^#[a-fA-F0-9]{6}$/',
                'secondary_color' => 'required|string|regex:/^#[a-fA-F0-9]{6}$/',
                'status' => 'required|in:active,inactive'
            ];
        }

        if ($this->isMethod('put')) {
            return [
                'name' => 'required|string|max:255|unique:schools,name,'.$this->school.',id',
                'slug' => 'nullable|string|max:255|unique:schools,slug,'.$this->school.',id',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'primary_color' => 'required|string|regex:/^#[a-fA-F0-9]{6}$/',
                'secondary_color' => 'required|string|regex:/^#[a-fA-F0-9]{6}$/',
                'status' => 'required|in:active,inactive'
            ];
        }

        return [];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('translate.School name is required'),
            'name.unique' => trans('translate.School name already exists'),
            'name.max' => trans('translate.School name may not be greater than 255 characters'),
            'slug.unique' => trans('translate.Slug already exists'),
            'slug.max' => trans('translate.Slug may not be greater than 255 characters'),
            'logo.image' => trans('translate.Logo must be an image'),
            'logo.mimes' => trans('translate.Logo must be jpeg, png, jpg or gif'),
            'logo.max' => trans('translate.Logo may not be greater than 2MB'),
            'primary_color.required' => trans('translate.Primary color is required'),
            'primary_color.regex' => trans('translate.Primary color must be a valid hex color'),
            'secondary_color.required' => trans('translate.Secondary color is required'),
            'secondary_color.regex' => trans('translate.Secondary color must be a valid hex color'),
            'status.required' => trans('translate.Status is required'),
            'status.in' => trans('translate.Status must be active or inactive')
        ];
    }
}