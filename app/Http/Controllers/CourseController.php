<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;

class CourseController extends Controller
{
    // عرض كل الدورات
    public function index()
    {
        if (auth()->check() && auth()->user()->role === 'student') {
            $courses = auth()->user()->enrolledCourses()->with('teacher', 'category')->get();
        } else {
            $courses = Course::with('teacher', 'category')->get();
        }

        return view('courses.index', compact('courses'));
    }

    // عرض دورة واحدة بالتفاصيل
    public function show($id)
    {
        $course = Course::with('teacher', 'category', 'lessons')->findOrFail($id);
        return view('courses.show', compact('course'));
    }

    // Show a dedicated roadmap page for a course
    public function roadmap($id)
    {
        $course = Course::with('teacher', 'category', 'lessons')->findOrFail($id);
        return view('courses.roadmap', compact('course'));
    }
}
