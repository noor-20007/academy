<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'mobile', 'age', 'requested_course_id'];

    protected $casts = [
        'approved' => 'boolean',
    ];

    // علاقة المدرس بالدورات اللي بيقدمها
    public function coursesTaught()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    // علاقة الطالب بالدورات المسجل فيها
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }

    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'student_id', 'course_id')->withPivot('progress_percentage', 'completed');
    }

    public function leaderboard()
    {
        return $this->hasOne(Leaderboard::class, 'student_id');
    }
}
