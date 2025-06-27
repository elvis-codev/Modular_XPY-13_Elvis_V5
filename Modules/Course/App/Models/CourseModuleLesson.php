<?php

namespace Modules\Course\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Course\Database\factories\CourseModuleLessonFactory;

class CourseModuleLesson extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'course_module_id',
        'name',
        'video_source',
        'video_id',
        'embed_url',
        'video_duration',
        'serial',
        'description',
        'is_public_lesson',
        'status'
    ];

}
