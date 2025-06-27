<?php

namespace Modules\Course\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseModuleLessonRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'name'=>'required|max:255',
            'description'=>'required',
            'content_type'=>'required|in:video,link',
            'video_duration'=>'required|numeric',
            'serial'=>'required|numeric'
        ];

        // Conditional validation based on content type
        if ($this->content_type === 'video') {
            $rules['video_source'] = 'required|in:youtube,vimeo';
            $rules['video_id'] = 'required|max:255';
        } elseif ($this->content_type === 'link') {
            $rules['embed_url'] = 'required|url|max:1000'; // Increased max length for URLs
        }

        return $rules;
    }

    public function messages(): array
    {
        return  [
            'description.required' => trans('translate.Description is required'),
            'name.required' => trans('translate.Name is required'),
            'serial.required' => trans('translate.Serial is required'),
            'content_type.required' => trans('translate.Content type is required'),
            'video_id.required' => trans('translate.Video is required'),
            'video_source.required' => trans('translate.Video source is required'),
            'embed_url.required' => trans('translate.Embed URL is required'),
            'embed_url.url' => trans('translate.Embed URL must be a valid URL'),
            'video_duration.required' => trans('translate.Video duration is required'),
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
