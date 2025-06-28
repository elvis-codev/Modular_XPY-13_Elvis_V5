<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'primary_color',
        'secondary_color',
        'status'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($school) {
            if (empty($school->slug)) {
                $school->slug = Str::slug($school->name);
            }
        });

        static::updating(function ($school) {
            if ($school->isDirty('name') && empty($school->getOriginal('slug'))) {
                $school->slug = Str::slug($school->name);
            }
        });
    }

    /**
     * Get all users belonging to this school.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'school_id');
    }

    /**
     * Get students belonging to this school.
     */
    public function students()
    {
        return $this->hasMany(User::class, 'school_id')->where('is_seller', '0');
    }

    /**
     * Get instructors belonging to this school.
     */
    public function instructors()
    {
        return $this->hasMany(User::class, 'school_id')->where('is_seller', '1');
    }

    /**
     * Get the logo URL.
     */
    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return asset('uploads/schools/' . $this->logo);
        }
        return asset('uploads/default-school-logo.png');
    }

    /**
     * Check if school is active.
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Scope for active schools.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get total students count.
     */
    public function getTotalStudentsAttribute()
    {
        return $this->students()->count();
    }

    /**
     * Get total instructors count.
     */
    public function getTotalInstructorsAttribute()
    {
        return $this->instructors()->count();
    }
}