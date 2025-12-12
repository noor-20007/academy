<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'category_id', 'teacher_id', 'thumbnail', 'roadmap'];

    protected $casts = [
        'roadmap' => 'array',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'student_id')->withPivot('progress_percentage', 'completed');
    }

    public function liveClasses()
    {
        return $this->hasMany(LiveClass::class);
    }
}
